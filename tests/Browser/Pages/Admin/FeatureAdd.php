<?php

namespace Tests\Browser\Pages\Admin;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class FeatureAdd extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/admin/feature/create';
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
            '@title' => 'input[name="description[title]"]',
            '@description' => 'textarea[name="description[description]"]',
            '@type' => 'select[name="properties[type]"]',
            '@status' => 'select[name="properties[status]"]',
            '@prefix' => 'input[name="description[prefix]"]',
            '@suffix' => 'input[name="description[suffix]"]',
            '@categories' => 'select[name="categories[]"]',
            '@variant' => 'input[name$="[value]"]',
            '@deleteVariant' => '#delete-variant',
            '@addVariant' => '#add-variant',
            '@submit' => '#submit',
        ];
    }
}
