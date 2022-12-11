<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\variation_optionsController;
use App\Http\Controllers\VariationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('api')->prefix('auth')->group(function () {

   Route::controller(UserAuthController::class)->group(function (){
       Route::post('login', 'login');
       Route::post('register', 'register');
       Route::get('refresh', 'refresh');
       Route::get('me', 'me');
       Route::get('logout', 'logout');
   });

});

Route::controller(ProductController::class)->prefix('product')->group( function() {
    Route::get('/all', 'index');
});



/*
|--------------------------------------------------------------------------
| API Routes For Admin
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('admin')->group(function () {

    Route::controller(AdminAuthController::class)->group(function (){
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::get('refresh', 'refresh');
        Route::get('me', 'me');
        Route::get('logout', 'logout');
    });

    Route::controller(ProductController::class)->prefix('product')->group(function (){
        Route::post('store', 'store');
        Route::put('update/{id}', 'update');
        Route::delete('destroy/{id}', 'destroy');
        Route::delete('delete-main-image/{id}', 'clearProductImage');
    });

    Route::controller(CategoryController::class)->prefix('category')->group(function (){
        Route::get('all', 'index');
        Route::get('category-info/{id}', 'getOneCategory');
        Route::post('store', 'store');
        Route::post('update/{id}', 'update');
        Route::delete('destroy/{id}', 'destroy');
//        Route::delete('delete-main-image/{id}', 'clearProductImage');
    });

    Route::controller(VariationController::class)->prefix('variation')->group(function (){
        Route::get('all', 'index');
        Route::post('store', 'store');
        Route::get('show/{id}', 'show');
        Route::post('update/{id}', 'update');
        Route::delete('delete/{id}', 'destroy');
    });

    Route::controller(variation_optionsController::class)->prefix('variation-options')->group(function (){
        Route::get('all', 'index');
        Route::post('store', 'store');
        Route::get('show/{id}', 'show');
        Route::post('update/{id}', 'update');
        Route::delete('delete/{id}', 'destroy');
    });

});
