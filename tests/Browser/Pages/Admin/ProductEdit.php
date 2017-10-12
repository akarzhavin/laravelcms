<?php

namespace Tests\Browser\Pages\Admin;

use App\Http\Models\Product;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class ProductEdit extends BasePage
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/admin/products/' . $this->product->id . '/edit';
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
            '@general_tab_btn' => 'a[aria-controls=general]',
            '@images_tab_btn' => 'a[aria-controls=images]',
            '@cost_tab_btn' => 'a[aria-controls=cost]',

            '@general' => '#general.tab-pane',
                '@status' => 'select[name="general[status]"]',
                '@title' => 'input[name="description[title]"]',
                '@short_title' => 'input[name="description[short_title]"]',
                '@short_description' => 'textarea[name="description[short_description]"]',
                '@full_description' => 'textarea[name="description[full_description]"]',
                '@meta_keywords' => 'input[name="description[meta_keywords]"]',
                '@meta_description' => 'input[name="description[meta_description]"]',
                '@category_main' => 'select[name="category_main"]',
                '@categories' => 'select[name="categories[]"]',
            '@images' => '#images.tab-pane',
                '@add' => 'button#add',
                '@browse' => 'input[name$="[file]"]',
                '@order' => 'input[name="images[0][order]"]',
                '@delete' => 'button#delete',
                '@main' => 'input[name="images_main"]',

            '@submit' => '.btn-primary.ui-btn-save',
            '@destroy' => '.btn-danger.ui-btn-delete'
        ];
    }
}
