<?php

namespace Tests\Browser;

use Tests\Browser\Pages\Admin\FeatureAdd;
use Tests\Browser\Pages\Admin\FeatureEdit;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\App;
use App\Http\Models\User;
use App\Http\Models\Category;
use App\Http\Models\Feature;

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

//    public function testFeaturesList()
//    {
//        $this->browse(function (Browser $browser) {
//            $browser->visit('/admin')
//                ->assertSee('Категории')
//                ->clickLink('Характеристики')
//                ->assertSee('Имя')
//                ->assertSee('Редактировать');
//        });
//    }

    public function testFeatureCreate()
    {
        $this->passFeatureData(new FeatureAdd);
    }

    public function testFeatureData()
    {
        $page = new FeatureEdit(Feature::orderBy('id', 'desc')->first());
        $this->checkFeatureData($page);
    }

    public function testFeatureUpdate()
    {
        $page = new FeatureEdit(Feature::orderBy('id', 'desc')->first());
        $this->passFeatureData($page);
    }

    public function testFeatureData2()
    {
        $page = new FeatureEdit(Feature::orderBy('id', 'desc')->first());
        $this->checkFeatureData($page);
    }

    public function testFeatureDelete()
    {
        $page = new FeatureEdit(Feature::orderBy('id', 'desc')->first());
        $this->browse(function (Browser $browser) use ($page) {
            $browser->visit($page);
            $browser->script('window.scrollTo(0, 0);');
            $browser->press('@destroy');
            $browser->waitForText('Имя');
        });

        $object = App::make('TestDataClass');
        $this->assertDatabaseMissing('feature_description', [
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

        $testData->faker('variant0')->word;
        $testData->faker('variant1')->word;
        $testData->faker('variant2')->word;
        $testData->faker('variant3')->word;
        $testData->faker('variant4')->word;
    }

    private function setCategories()
    {
        $testData = App::make('TestDataClass');

        $category = Category::orderByRaw('RAND()')->first();
        $testData->set('category', $category);
    }

    private function passFeatureData($page)
    {
        $this->setProps();
        $this->setCategories();
        $this->browse(function (Browser $browser) use ($page) {
            $browser->visit($page);

            $this->passGeneral($browser);
            $this->passVariants($browser);

            $browser->script('window.scrollTo(0, 0);');
            $browser->pause(100);
            $browser->press('@submit');
            $browser->waitForText('Имя');
        });
    }

    private function passGeneral($browser)
    {
        $object = App::make('TestDataClass');

        $general = $browser;
        $general->type('@title', $object->get('@title'));
        $general->type('@description', $object->get('@description'));
        $general->select('@type', $object->get('@type'));
        $general->type('@prefix', $object->get('@prefix'));
        $general->type('@suffix', $object->get('@suffix'));
        $general->select('@status', $object->get('@status'));
        $general->select('@categories', $object->get('category')->id);
    }

    private function passVariants($browser)
    {
        $variants = $browser;

        for($i = 0; $i < 4; $i++){
            $variants->script('window.scrollTo(0, document.body.scrollHeight);');
            $variants->press('@addVariant');
            $variants->pause(50);
        }

        $object = App::make('TestDataClass');
        $elements = $variants->elements('@variant');
        foreach($elements as $key => $element){
            $attr = $element->getAttribute('name');
            $variants->type($attr, $object->get('variant'.$key));
        }

    }

    private function checkFeatureData($page)
    {
        $this->browse(function (Browser $browser) use ($page) {
            $browser->visit($page);

            $this->checkGeneral($browser);
            $this->checkVariants($browser);
        });
    }

    private function checkGeneral($browser)
    {
        $object = App::make('TestDataClass');

        $general = $browser;
        $general->assertInputValue('@title', $object->get('@title'));
        $general->assertInputValue('@description', $object->get('@description'));
        $general->assertSelectHasOption('@type', $object->get('@type'));
        $general->assertInputValue('@prefix', $object->get('@prefix'));
        $general->assertInputValue('@suffix', $object->get('@suffix'));
        $general->assertSelectHasOption('@status', $object->get('@status'));
        $general->assertSelectHasOption('@categories', $object->get('category')->id);
    }

    private function checkVariants($browser)
    {
        $object = App::make('TestDataClass');

        $variants = $browser;

        $variants->assertSourceHas($object->get('variant0'));
        $variants->assertSourceHas($object->get('variant1'));
        $variants->assertSourceHas($object->get('variant2'));
        $variants->assertSourceHas($object->get('variant3'));
        $variants->assertSourceHas($object->get('variant4'));
    }
}
