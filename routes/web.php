<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Darryldecode\Cart\Facades\CartFacade as Cart;

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

Route::get('/', function () {
  // return view('welcome');
    return redirect()->route('products.index');
});

/*Products route*/
Route::get('/boutique', 'ProductController@index')->name('products.index');
Route::get('/boutique/{slug}', 'ProductController@show')->name('products.show');
Route::get('/search', 'ProductController@search')->name('products.search');

/*Orders route*/
Route::get('/commandes', 'OrderController@index')->name('orders.index');
Route::get('/commandes/telecharger', 'OrderController@getPostPdf')->name('orders.download');



/* Checkout route          */
Route::get('/paiement', 'CheckoutController@index')->name('checkout.index');
Route::post('/paiement', 'CheckoutController@store')->name('checkout.store');
Route::get('/merci', 'CheckoutController@thankYou')->name('checkout.thankYou');
Route::get('/paiement/telecharger', 'CheckoutController@getPostPdf')->name('checkout.download');
Route::get('/commandes/livreur', 'CheckoutController@livreur')->name('checkout.livreur');


/*Auth route          */
Auth::routes();

/*Home route          */
Route::get('/home', 'HomeController@index')->name('home');

/*Cart route          */
Route::group(['middleware' => ['auth']], function () {
Route::post('/panier/ajouter', 'CartController@store')->name('cart.store');
Route::get('/panier', 'CartController@index')->name('cart.index');
Route::delete('/panier/{rowId}', 'CartController@destroy')->name('cart.destroy');
Route::put('/panier/{rowId}', 'CartController@update')->name('cart.update');
Route::post('/coupon', 'CartController@storeCoupon')->name('cart.store.coupon');
Route::delete('/coupon', 'CartController@destroyCoupon')->name('cart.destroy.coupon');
});

/*Admin route          */
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
