<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
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
   }) ;

   Route::controller(UserController::class)->prefix('user')->group(function (){
       Route::post('update-profile', 'update');
       Route::post('update-profile', 'update');
       Route::post('update-profile', 'update');
   });



});

Route::controller(AddressController::class)->middleware('api')->prefix('address')->group(function (){
    Route::post('add-address', 'store');
    Route::post('update-address/{id}', 'update');
    Route::delete('delete-address/{id}', 'destroy');
});


Route::prefix('admin')->group(function () {

    Route::controller(AdminAuthController::class)->group(function (){
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::get('refresh', 'refresh');
        Route::get('me', 'me');
        Route::get('logout', 'logout');
    });

    Route::controller(ProductController::class)->group(function (){
        Route::post('store', 'store');
        Route::put('update/{id}', 'update');
        Route::delete('destroy/{id}', 'destroy');
    });

});
