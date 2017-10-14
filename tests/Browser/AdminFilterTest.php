<?php

namespace Tests\Browser;

use App\Http\Models\Category;
use App\Http\Models\Feature;
use App\Http\Models\Filter;
use App\Http\Models\User;
use Illuminate\Support\Facades\App;
use Tests\Browser\Pages\Admin\FilterAdd;
use Tests\Browser\Pages\Admin\FilterEdit;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminFilterTest extends DuskTestCase
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

    public function testFilterCreate()
    {
        $this->passFilterData(new FilterAdd);
    }

    public function testFilterData()
    {
        $page = new FilterEdit(Filter::orderBy('id', 'desc')->first());
        $this->checkFilterData($page);
    }

    public function testFilterUpdate()
    {
        $page = new FilterEdit(Filter::orderBy('id', 'desc')->first());
        $this->passFilterData($page);
    }

    public function testFilterData2()
    {
        $page = new FilterEdit(Filter::orderBy('id', 'desc')->first());
        $this->checkFilterData($page);
    }

    public function testFilterDelete()
    {
        $page = new FilterEdit(Filter::orderBy('id', 'desc')->first());
        $this->browse(function (Browser $browser) use ($page) {
            $browser->visit($page);
            $browser->script('window.scrollTo(0, 0);');
            $browser->press('@destroy');
            $browser->waitForText('Имя');
        });

        $object = App::make('TestDataClass');
        $this->assertDatabaseMissing('filters', [
            'title' => $object->get('@title')
        ]);
        $object->fresh();
    }

    private function setProps()
    {
        $testData = App::make('TestDataClass');
        $testData->faker('@title')->uuid;
        $testData->set('@display', 'D');
        $testData->set('@type', 'feature');
        $testData->set('@status', 'A');
    }

    private function setCategories()
    {
        $testData = App::make('TestDataClass');

        $category = Category::orderByRaw('RAND()')->first();
        $testData->set('category', $category);
    }

    private function setFeature()
    {
        $testData = App::make('TestDataClass');

        $feature = Feature::orderByRaw('RAND()')->first();
        $testData->set('feature', $feature);
    }

    private function passFilterData($page)
    {
        $this->setProps();
        $this->setCategories();
        $this->setFeature();

        $this->browse(function (Browser $browser) use ($page) {
            $browser->visit($page);

            $this->passGeneral($browser);

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
        $general->select('@type', $object->get('@type'));
        $general->select('@status', $object->get('@status'));
        $general->select('@display', $object->get('@display'));
        $general->select('@categories', $object->get('category')->id);
        $general->select('@feature', $object->get('feature')->id);
    }

    private function checkFilterData($page)
    {
        $this->browse(function (Browser $browser) use ($page) {
            $browser->visit($page);
            $this->checkGeneral($browser);
        });
    }

    private function checkGeneral($browser)
    {
        $object = App::make('TestDataClass');

        $general = $browser;
        $general->assertInputValue('@title', $object->get('@title'));
        $general->assertSelectHasOption('@type', $object->get('@type'));
        $general->assertSelectHasOption('@display', $object->get('@display'));
        $general->assertSelectHasOption('@status', $object->get('@status'));
        $general->assertSelectHasOption('@categories', $object->get('category')->id);
        $general->assertSelectHasOption('@feature', $object->get('feature')->id);
    }
}
