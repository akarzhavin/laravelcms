<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 17.08.2017
 * Time: 14:17
 */

Auth::routes();
Route::get('/', 'ShopController@home');
Route::get('home', 'ShopController@home');

Route::post('search', 'ShopController@search');
