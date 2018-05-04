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
/* Page displays */
Route::get('/', 'HomeController@index');
Route::get('products', function () {
   return view('products');
});
Route::get('/thanks', 'ThanksController@index');
Route::get('/admin', 'AdminController@index');
Route::get('/checkout', 'CheckoutController@index');
Route::get('customer', function () {
    return view('customer');
});
Route::get('/product', 'ProductController@index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
