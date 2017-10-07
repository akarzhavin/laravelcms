<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 30.07.2017
 * Time: 14:54
 */

Route::get('/', 'ShopController@catalog');
Route::get('product/{slug}', 'ShopController@productDetails');

Route::get('/{category}', 'ShopController@category')
    ->where('category', '^(\/?(?!product)[0-9\-]*)*$');

Route::post('/{category}', 'ShopController@filterRedirect')
    ->where('category', '^(\/?(?!product)[0-9\-]*)*$')->name('category');

Route::get('/{category}/product/{product}', 'ShopController@productDetails')
    ->where('category', '^(\/?(?!product)[0-9\-]*)*$')
    ->where('product', '([A-Za-z0-9\-]+)');
