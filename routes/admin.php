<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 30.07.2017
 * Time: 13:53
 */
Route::get('/', 'AdminController@welcome');
Route::resource('categories', 'CategoryController');
Route::resource('products', 'ProductController', ['except' => [
    'show', 'update'
]]);
Route::match(array('PUT', 'PATCH'), "/products/{product}/edit", array(
    'uses' => 'ProductController@update',
    'as' => 'products.update'));

Route::resource('feature', 'FeatureController', ['except' => ['show']]);
Route::resource('filter', 'FilterController', ['except' => ['show']]);
Route::resource('gallery', 'GalleryController', ['except' => ['show']]);