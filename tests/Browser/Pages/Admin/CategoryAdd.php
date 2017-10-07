<?php

namespace Tests\Browser\Pages\Admin;

use App\Http\Models\Category;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class CategoryAdd extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/admin/categories/create';
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
            '@title' => 'input[name=title]',
            '@description' => 'textarea[name=description]',
            '@status' => 'select[name=status]',
            '@parent_id' => 'select[name=parent_id]',
            '@meta_keywords' => 'input[name=meta_keywords]',
            '@meta_description' => 'input[name=meta_description]',
            '@page_title' => 'input[name=page_title]',
            '@submit' => '.btn-primary',
            '@delete' => '.btn-danger'
        ];
    }
}
