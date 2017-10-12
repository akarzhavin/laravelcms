<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminFeatureTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/admin');
        });
    }

    public function testFeaturesList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->assertSee('Категории')
                ->clickLink('Характеристики')
                ->assertSee('Имя')
                ->assertSee('Редактировать');
        });
    }

    public function testFeatureCreate()
    {
        $this->passProductData(new ProductAdd);
    }

    public function testFeatureData()
    {
        $page = new ProductEdit(Product::orderBy('id', 'desc')->first());
        $this->checkProductData($page);
    }

    public function testFeatureUpdate()
    {
        $page = new ProductEdit(Product::orderBy('id', 'desc')->first());
        $this->passProductData($page);
    }

    public function testFeatureData2()
    {
        $page = new ProductEdit(Product::orderBy('id', 'desc')->first());
        $this->checkProductData($page);
    }

    public function testFeatureDelete()
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
        $testData->faker('@description')->paragraph;
        $testData->set('@type', 'CheckMulti');
        $testData->set('@status', 'A');
        $testData->faker('@prefix')->word;
        $testData->faker('@suffix')->word;

        $testData->faker('@variant1')->word;
        $testData->faker('@variant2')->word;
        $testData->faker('@variant3')->word;
        $testData->faker('@variant4')->word;
        $testData->faker('@variant5')->word;
    }

    private function setCategories()
    {
        $testData = App::make('TestDataClass');

        $category = Category::orderByRaw('RAND()')->first();
        $testData->set('otherCategory', $category);
    }

}
