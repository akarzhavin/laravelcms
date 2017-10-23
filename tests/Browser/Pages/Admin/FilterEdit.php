<?php

namespace Tests\Browser\Pages\Admin;

use App\Http\Models\Filter;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class FilterEdit extends BasePage
{
    protected $filter;

    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/admin/filter/' . $this->filter->id . '/edit';
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
            '@status' => 'select[name="properties[status]"]',
            '@display' => 'select[name="properties[display]"]',
            '@displayCount' => 'input[name="properties[display_count]"]',
            '@roundTo' => 'input[name="properties[other][round_to]"]',
            '@title' => 'input[name="properties[title]"]',
            '@type' => 'select[name="properties[type]"]',
            '@feature' => 'select[name="properties[feature_id]"]',
            '@categories' => 'select[name="categories[]"]',
            '@submit' => '#submit',
            '@destroy' => '#destroy',
        ];
    }
}
