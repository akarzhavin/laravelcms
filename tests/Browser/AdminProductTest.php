<?php

namespace Tests\Browser;

use App\Http\Models\Category;
use App\Http\Models\User;
use Illuminate\Support\Facades\App;
use Tests\Browser\Pages\Admin\ProductAdd;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdminProductTest extends DuskTestCase
{
    private function setProps()
    {
        $testData = App::make('TestDataClass');
        $testData->faker('@title')->title;
        $testData->faker('@short_title')->sentence;
        $testData->faker('@short_description')->paragraph;
        $testData->faker('@full_description')->text;
        $testData->faker('@meta_keywords')->words($nb = 3, $asText = true);
        $testData->faker('@meta_description')->sentence;
        $testData->faker('@category_main')->word;
        $testData->faker('@categories')->word;
        $testData->set('@status', 'D');
    }


    private function setCategories()
    {
        $categories = Category::orderByRaw('RAND()')->take(2)->get();

        $testData = App::make('TestDataClass');
        $main = $categories->pull(0);
        $other = $categories->pull(1);

        $testData->set('mainCategory', $main);
        $testData->set('otherCategory', $other);
    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/admin');
        });
    }

    public function testProductsList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->assertSee('Категории')
                ->clickLink('Товары')
                ->assertSee('Имя')
                ->assertSee('Редактировать');
        });
    }

    public function testProductCreate()
    {
        $this->setProps();
        $this->setCategories();
        $this->browse(function (Browser $browser) {
            $object = App::make('TestDataClass');
            $browser->visit(new ProductAdd);

            $browser->press('@general_tab_btn');
            $browser->with('@general', function ($general) use ($object) {
                $general->type('@title', $object->get('@title'));
                $general->type('@short_title', $object->get('@short_title'));
                $general->type('@short_description', $object->get('@short_description'));
                $general->type('@full_description', $object->get('@full_description'));
                $general->type('@meta_keywords', $object->get('@meta_keywords'));
                $general->type('@meta_description', $object->get('@meta_description'));
                $general->select('@category_main', $object->get('mainCategory')->id);
                $general->select('@categories', $object->get('otherCategory')->id);
                $general->select('@status', $object->get('@status'));
            });

            $browser->press('@images_tab_btn');
            $browser->with('@general', function ($general) use ($object) {
                $general->type('@title', $object->get('@title'));
                $general->type('@short_title', $object->get('@short_title'));
                $general->type('@short_description', $object->get('@short_description'));
                $general->type('@full_description', $object->get('@full_description'));
                $general->type('@meta_keywords', $object->get('@meta_keywords'));
                $general->type('@meta_description', $object->get('@meta_description'));
                $general->select('@category_main', $object->get('mainCategory')->id);
                $general->select('@categories', $object->get('otherCategory')->id);
                $general->select('@status', $object->get('@status'));
            });

        });
    }

}
