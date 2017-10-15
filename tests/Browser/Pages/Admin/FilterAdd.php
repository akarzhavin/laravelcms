<?php

namespace Tests\Browser\Pages\Admin;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class FilterAdd extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/admin/filter/create';
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
            '@submit' => '#submit'
        ];
    }
}
