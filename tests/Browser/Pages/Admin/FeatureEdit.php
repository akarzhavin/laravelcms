<?php

namespace Tests\Browser\Pages\Admin;

use App\Http\Models\Feature;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class FeatureEdit extends BasePage
{
    protected $feature;

    public function __construct(Feature $feature)
    {
        $this->feature = $feature;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/admin/feature/' . $this->feature->id . '/edit';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
