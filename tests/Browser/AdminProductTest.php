<?php

namespace Tests\Browser;

use App\Http\Models\Category;
use App\Http\Models\Product;
use App\Http\Models\User;
use Illuminate\Support\Facades\App;
use Tests\Browser\Pages\Admin\ProductAdd;
use Tests\Browser\Pages\Admin\ProductEdit;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdminProductTest extends DuskTestCase
{
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
        $this->passProductData(new ProductAdd);
    }

    public function testProductData()
    {
        $page = new ProductEdit(Product::orderBy('id', 'desc')->first());
        $this->checkProductData($page);
    }

    public function testProductUpdate()
    {
        $page = new ProductEdit(Product::orderBy('id', 'desc')->first());
        $this->passProductData($page);
    }

    public function testProductData2()
    {
        $page = new ProductEdit(Product::orderBy('id', 'desc')->first());
        $this->checkProductData($page);
    }

    public function testProductDelete()
    {
        $page = new ProductEdit(Product::orderBy('id', 'desc')->first());
        $this->browse(function (Browser $browser) use ($page) {
            $browser->visit($page);
            $browser->script('window.scrollTo(0, 0);');
            $browser->press('@destroy');
            $browser->waitForText('Имя');
        });

        $object = App::make('TestDataClass');
        $this->assertDatabaseMissing('category_description', [
            'title' => $object->get('@title')
        ]);
        $object->fresh();
    }

    private function setProps()
    {
        $testData = App::make('TestDataClass');
        $testData->faker('@title')->uuid;
        $testData->faker('@short_title')->text($maxNbChars = 60);
        $testData->faker('@short_description')->paragraph;
        $testData->faker('@full_description')->text;
        $testData->faker('@meta_keywords')->words($nb = 3, $asText = true);
        $testData->faker('@meta_description')->sentence;
        $testData->faker('@category_main')->word;
        $testData->faker('@categories')->word;
        $testData->set('@status', 'A');
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

    private function passProductData($page)
    {
        $this->setProps();
        $this->setCategories();
        $this->browse(function (Browser $browser) use ($page) {
            $browser->visit($page);

            $browser->script('window.scrollTo(0, 0);');
            $browser->pause(100);
            $this->passGeneral($browser);
            $browser->script('window.scrollTo(0, 0);');
            $browser->pause(100);
            $this->passImages($browser);

            $browser->script('window.scrollTo(0, 0);');
            $browser->pause(100);
            $browser->press('@submit');
            $browser->waitForText('Имя');
        });
    }

    private function checkProductData($page)
    {
        $this->browse(function (Browser $browser) use ($page) {
            $browser->visit($page);

            $this->checkGeneral($browser);
            $this->checkImages($browser);
        });
    }

    private function passGeneral($browser)
    {
        $object = App::make('TestDataClass');
        $browser->press('@general_tab_btn');
        $browser->with('@general', function ($general) use ($object) {
            $general->type('@title', $object->get('@title'));
            $general->type('@short_title', $object->get('@short_title'));
            $general->type('@short_description', $object->get('@short_description'));
            $general->type('@full_description', $object->get('@full_description'));
            $general->type('@meta_keywords', $object->get('@meta_keywords'));
            $general->type('@meta_description', $object->get('@meta_description'));
            $general->select('@status', $object->get('@status'));
            $general->select('@category_main', $object->get('mainCategory')->id);
            $general->select('@categories', $object->get('otherCategory')->id);
        });
    }

    private function checkGeneral($browser)
    {
        $object = App::make('TestDataClass');
        $browser->press('@general_tab_btn');
        $browser->with('@general', function ($general) use ($object) {
            $general->assertInputValue('@title', $object->get('@title'));
            $general->assertInputValue('@short_title', $object->get('@short_title'));
            $general->assertInputValue('@short_description', $object->get('@short_description'));
            $general->assertInputValue('@full_description', $object->get('@full_description'));
            $general->assertInputValue('@meta_keywords', $object->get('@meta_keywords'));
            $general->assertInputValue('@meta_description', $object->get('@meta_description'));
            $general->assertSelectHasOption('@status', $object->get('@status'));
            $general->assertSelectHasOption('@category_main', $object->get('mainCategory')->id);
            $general->assertSelectHasOption('@categories', $object->get('otherCategory')->id);
        });
    }

    private function passImages($browser)
    {
        $object = App::make('TestDataClass');

        $browser->press('@images_tab_btn');
        $browser->with('@images', function ($imagesTab) use ($object) {
            $imagesTab->attach('@browse', base_path('/tests/images/test1.jpg'));
        });
    }

    private function checkImages($browser)
    {
        $object = App::make('TestDataClass');
        $browser->press('@images_tab_btn');
        $browser->with('@images', function ($images) use ($object) {
            $images->assertSourceHas('test1.jpg');
        });
    }
}
