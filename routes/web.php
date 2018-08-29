<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/hello', function () {
    //return view('welcome');
    return '<h1>Hello World</h1>';
});

Route::get('/users/{id}/{name}', function($id, $name){
    return 'This is user '.$name.' with an id of '.$id;
});
*/

Route::get('/', 'PagesController@index')->name('home');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::get('shop/{slug}', 'ShopController@brand');
Route::resource('shop', 'ShopController');

Route::resource('watches', 'ProductController');
Route::get('/watches/{slugBrand}/{slugProduct}', 'ProductController@showProduct');
Route::post('/watches/{slugBrand}/{slugProduct}/comments', 'CommentsController@store')->name('watches.comment');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

// Product comparing
Route::get('compare/{id}', 'CompareController@compare');
Route::get('comparing', 'CompareController@comparing')->name('comparing');
