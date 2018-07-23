<?php

use Illuminate\Http\Request;

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

Route::get('/', 'HomeController@index');

Route::get('/shop', function () {
    return view('user.shop');
})->name('view.shop');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace'=>'Admin', 'prefix' => 'admin'], function ()
{
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/home', 'AdminController@index')->name('admin.dashboard');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::resource('category', 'CategoryController');
    Route::get('subcategory/list/{id}', 'SubCategoryController@getsubcategories')->name('sub.name');
    Route::resource('product', 'ProductController');
    Route::resource('brand', 'BrandController'); 
    Route::resource('subcategory', 'SubCategoryController'); 
});
Route::group(['namespace' => 'User'], function()
{
    Route::get('/products', 'ProductController@allProduct')->name('all.product');
    // CART 
    Route::get('/cart', 'CartController@viewCart')->name('view.cart'); 
    Route::post('/updateCart', 'CartController@updateCart')->name('update.cart'); 
    Route::get('/addCart', 'CartController@addMultipleCart')->name('product.multiple.cart'); 
    // PROFILE
    Route::get('/user/profile', 'UserController@viewProfile')->name('view.profile'); 
    Route::post('/user/profile', 'UserController@changePassword')->name('change.user.password'); 
    Route::put('/user/profile', 'UserController@updateProfile')->name('update.user.profile');
    // CART SINGLE 
    Route::get('/add-to-cart/{id}', 'CartController@addToCart')->name('product.add.cart')->where('id', '[0-9]+'); 
    Route::get('/remove-from-cart/{id}', 'CartController@removeFromCart')->name('product.remove.cart')->where('id', '[0-9]+');
    // SINGLE PRODUCT 
    Route::get('/{category}/{id}/{slug}', 'ProductController@showProduct')->name('view.product')->where('id', '[0-9]+');
    // ORDER
    Route::get('/orders', 'OrderController@viewOrders')->name('view.order');  
    // Route::put('/user/profile', 'UserController@updateProfile')->name('update.user.profile'); 
    // Route::post('/user/profile', 'UserController@changePassword')->name('change.user.password');
    // CHECKOUT
    Route::get('/shop/checkout', 'CheckoutController@view')->name('user.checkout'); 
    Route::post('/shop/checkout', 'CheckoutController@address')->name('user.checkout.address');
    // PAYMENT API
    Route::group(['prefix' => 'checkout'], function()
    {
        Route::get('/payment/callback', 'PaymentController@handleGatewayCallback'); 
        Route::post('/pay', 'PaymentController@redirectToGateway')->name('checkout.pay');
    });
    // PAYMENT FORM
    Route::group(['middleware' => 'nocache'], function()
    {
        Route::get('/shop/checkout/payment', 'CheckoutController@viewPaymentForm')->name('user.checkout.payment'); 
        Route::get('/order/checkout/payment/transaction', 'OrderController@orderCompleted')->name('order.completed'); 
    });  
});