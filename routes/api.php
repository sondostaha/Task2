<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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
Route::post('register',[AuthController::class ,'register']);
Route::post('login',[AuthController::class ,'login']);

Route::group(['perfix'=> 'users' , 'middleware' => 'auth:api'],function(){
    
    //categories
    Route::group(['perfix' => 'Categories'], function(){

        Route::get('/',[CategoryController::class,'index']);
        Route::get('add',[CategoryController::class,'create']);
        Route::get('update/{id}',[CategoryController::class,'update']);
        Route::get('delete/{id}',[CategoryController::class,'delete']);

    });
    Route::post('logout',[AuthController::class ,'logout']);

});
