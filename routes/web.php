<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\Website\SiteController@home')->name('site.home');
Route::get('about-us', 'App\Http\Controllers\Website\SiteController@aboutUs')->name('site.about_us');
// Route::resource('cart', 'App\Http\Controllers\Website\CartController');
Route::get('cart/addToCart/{product_id}', 'App\Http\Controllers\Website\CartController@addToCart')->name('cart.add_to_cart');
Route::get('cart/removeFromCart/{cart_item_id}', 'App\Http\Controllers\Website\CartController@removeFromCart')->name('cart.remove_from_cart');
Route::get('cart/emptyCart', 'App\Http\Controllers\Website\CartController@emptyCart')->name('cart.empty_cart');

Auth::routes();

// custom login for modal
Route::post('authenticate', 'App\Http\Controllers\Auth\CustomLoginController@authenticate');
Route::post('customer-registration', 'App\Http\Controllers\Website\CustomerRegistrationController@store');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'App\Http\Controllers\RedirectController@index')->name('redirect');

    Route::prefix('cms')->group(function () {
        Route::prefix('website')->group(function () {
            Route::resource('homepage-sliders', 'App\Http\Controllers\CMS\Website\HomepageSliderController');
            Route::resource('members', 'App\Http\Controllers\CMS\Website\MemberController');
        });

        Route::prefix('manage-products')->group(function () {
            Route::resource('categories', 'App\Http\Controllers\CMS\ManageProducts\CategoryController');
            Route::resource('products', 'App\Http\Controllers\CMS\ManageProducts\ProductController');
        });

        Route::prefix('manage-orders')->group(function () {
            Route::resource('orders', 'App\Http\Controllers\CMS\ManageOrders\OrderController');
        });
    });

    Route::prefix('customer')->group(function () {
        Route::resource('customer-profile', 'App\Http\Controllers\Customer\CustomerProfileController')->only(['store']);
        Route::resource('my-address', 'App\Http\Controllers\Customer\MyAddressController')->only(['index', 'store']);
        Route::resource('wishlist', 'App\Http\Controllers\Customer\WishlistController');
        Route::resource('orderlist', 'App\Http\Controllers\Customer\OrderlistController');
    });

    Route::resource('checkout', 'App\Http\Controllers\Website\CheckoutController')->only(['index', 'store']);
    Route::get('checkout/success', 'App\Http\Controllers\Website\CheckoutController@success')->name('checkout.success');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
