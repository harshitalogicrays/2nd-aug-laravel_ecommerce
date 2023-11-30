<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AOrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;

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
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[DashboardController::class,'index']);  
    Route::prefix('category')->controller(CategoryController::class)->group(function () {
    Route::get('','index');
    Route::get('/create','create');
    Route::post('','store');
    Route::get('/delete/{id}','delete');
    Route::get('/edit/{id}','edit');
    Route::post('/update/{id}','update'); 
    });

    Route::get('products',[ProductController::class,'index']);
    Route::get('product/create',[ProductController::class,'create']);
    Route::post('product',[ProductController::class,'store']);
    Route::get('product/delete/{id}',[ProductController::class,'delete']);
    Route::get('product/edit/{id}',[ProductController::class,'edit']);
    Route::put('product/update/{id}',[ProductController::class,'update']);
    Route::get('product-image/delete/{id}',[ProductController::class,'destroy']);

        Route::controller(SliderController::class)->group(function(){
            Route::get('sliders','index');
            Route::get('slider/create','create');
            Route::post('sliders','add');
        });

        Route::controller(AOrderController::class)->group(function(){
            Route::get('orders','index');
            Route::get('orders/view/{id}','showorder');
            Route::put('orders/{id}','updateorderstatus');
            Route::get('order/invoice/{id}','invoice');
            Route::get('orders/download/invoice/{id}','downloadpdf');
            Route::get('orders/sendmail/{id}','sendinvoiceonmail');
        });
    
        Route::controller(UserController::class)->group(function(){
            Route::get('users','index');
            Route::get('user/create','create');
            Route::post('user/store','store');
            Route::get('user/delete/{id}','delete');
        });

});
    

Route::get('/',[FrontendController::class,'index']);
Route::get('/search',[FrontendController::class,'searchproducts']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/collections',[FrontendController::class,'collection']);
Route::get('/collections/{category}',[FrontendController::class,'cproducts']);
Route::get('/collection/{category}/{product}',[FrontendController::class,'viewproduct']);
Route::get('/cart',[CartController::class,'index']);
Route::get('/checkout-show',[CheckoutController::class,'checkoutShow']);
Route::get('thank-you',[CheckoutController::class,'thankyou']);
Route::get('myorders',[OrderController::class,'index']);
Route::get('orders/{orderid}',[OrderController::class,'showorder']);
Route::get('profile',[UserController::class,'profile']);
Route::post('profile',[UserController::class,'saveprofile']);
Route::get('change_password',[UserController::class,'change_password']);
Route::post('change_password',[UserController::class,'update_password']);