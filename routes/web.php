<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::get('/', function () {
    return view('layouts.main');
});*/
//\View::share('catnav', \App\Category::all());
Route::get('/', array('uses' => 'StoreController@index'));


Route::resource('admin/categories', 'CategoriesController');
Route::resource('admin/products', 'ProductsController');

Route::resource('store', 'StoreController');
Route::get('store/category/{cat_id}', 'StoreController@getCategory');
Route::get('store/products/search', 'StoreController@getSearch');
Route::post('store/item/addtocart', 'StoreController@postAddtocart');
Route::get('store/cart/items', 'StoreController@getCart');
Route::get('store/cart/remove/{id}', 'StoreController@getRemoveitem');
Route::get('contact', 'StoreController@getContact');

Route::get('users/newaccount', 'UsersController@getNewaccount');
Route::post('users/create', 'UsersController@postCreate');
Route::get('users/signin', 'UsersController@getSignin');
Route::post('users/signin', 'UsersController@postSignin');
Route::get('users/signout', 'UsersController@getSignout');
Route::get('users/newaccount', 'UsersController@getNewaccount');