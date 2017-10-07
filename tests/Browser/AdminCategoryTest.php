<?php

namespace Tests\Browser;

use App\Http\Models\Category;
use App\Http\Models\User;

use Tests\Browser\Pages\Admin\CategoriesList;
use Tests\Browser\Pages\Admin\CategoryAdd;
use Tests\Browser\Pages\Admin\CategoryEdit;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\App;

class AdminCategoryTest extends DuskTestCase
{

    private function setProps()
    {
        $testData = App::make('TestDataClass');
        $testData->faker('@title')->uuid;
        $testData->faker('@description')->text;
        $testData->faker('@meta_keywords')->sentence;
        $testData->faker('@meta_description')->sentence;
        $testData->faker('@page_title')->word;
    }

    private function setParentCategory()
    {
        $parentCategory = Category::orderByRaw('RAND()')->first();

        $testData = App::make('TestDataClass');
        $testData->set('parentCategory', $parentCategory);
    }

    public function testLogin()
    {
        $this->setProps();
        $this->setParentCategory();
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/admin');
        });
    }

    public function testCategoriesList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->assertSee('Категории')
                ->clickLink('Категории')
                ->assertSee('Имя')
                ->assertSee('Редактировать');
        });
    }

    public function testCategoryCreate()
    {
        $object = App::make('TestDataClass');
        $this->browse(function ($browser) use ($object) {
            $browser->visit(new CategoryAdd)
                ->type('@title', $object->get('@title'))
                ->type('@description', $object->get('@description'))
                ->type('@meta_keywords', $object->get('@meta_keywords'))
                ->type('@meta_description', $object->get('@meta_description'))
                ->type('@page_title', $object->get('@page_title'))
                ->select('@parent_id', $object->get('parentCategory')->id);
            $browser->script('window.scrollTo(0, 0);');
            $browser->press('Сохранить');
            $browser->assertSee('Имя');
        });
        $this->assertDatabaseHas('category_description', [
            'title' => $object->get('@title')
        ]);

        $currentCategory = Category::orderBy('id', 'desc')->first();
        $object->set('currentCategory', $currentCategory);
    }

    public function testCategoryData()
    {
        $object = App::make('TestDataClass');
        $this->browse(function ($browser) use ($object) {
            $browser->visit(new CategoryEdit($object->get('currentCategory')))
                ->assertInputValue('@title', $object->get('@title'))
                ->assertInputValue('@description', $object->get('@description'))
                ->assertInputValue('@meta_keywords', $object->get('@meta_keywords'))
                ->assertInputValue('@meta_description', $object->get('@meta_description'))
                ->assertInputValue('@page_title', $object->get('@page_title'))
                ->assertSelectHasOption('@parent_id', $object->get('parentCategory')->id);
        });
    }


    public function testCategoryUpdate()
    {
        $this->setParentCategory();
        $object = App::make('TestDataClass');
        $object->refresh();

        $this->browse(function ($browser) use ($object) {
            $browser->visit(new CategoryEdit($object->get('currentCategory')))
                ->type('@title', $object->get('@title'))
                ->type('@description', $object->get('@description'))
                ->type('@meta_keywords', $object->get('@meta_keywords'))
                ->type('@meta_description', $object->get('@meta_description'))
                ->type('@page_title', $object->get('@page_title'))
                ->select('@parent_id', $object->get('parentCategory')->id);
            $browser->script('window.scrollTo(0, 0);');
            $browser->press('Сохранить');
            $browser->assertSee('Имя');
        });

        $this->assertDatabaseHas('category_description', [
            'title' => $object->get('@title')
        ]);

        $this->testCategoryData();
    }

    public function testDeleteCategory()
    {
        $object = App::make('TestDataClass');
        $this->browse(function ($browser) use ($object) {
            $browser->visit(new CategoryEdit($object->get('currentCategory')))
                ->press('@delete')
                ->assertSee('Имя');
        });
        $this->assertDatabaseMissing('category_description', [
            'title' => $object->get('@title')
        ]);
    }
}
