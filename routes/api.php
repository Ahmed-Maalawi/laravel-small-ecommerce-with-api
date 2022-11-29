<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;
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

});


Route::prefix('admin')->group(function () {

    Route::controller(AdminAuthController::class)->group(function (){
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::get('refresh', 'refresh');
        Route::get('me', 'me');
        Route::get('logout', 'logout');
    }) ;

});
