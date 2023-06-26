<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
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

Route::middleware('auth:api')->group( function(){
    
    //categories
    Route::prefix('categories')->group( function(){

        Route::get('/',[CategoryController::class,'index']);
        Route::post('add',[CategoryController::class,'create']);
        Route::get('show/{id}',[CategoryController::class,'show']);
        Route::put('update/{id}',[CategoryController::class,'update']);
        Route::post('delete/{id}',[CategoryController::class,'delete']);
        Route::post('retrieve',[CategoryController::class,'restoreCategories']);
        Route::post('retrieve/category/{id}',[CategoryController::class,'restoreCategory']);


        

    });

     //posts
     Route::prefix('posts')->group( function(){

        Route::get('/',[PostController::class,'index']);
        Route::post('add',[PostController::class,'create']);

        Route::get('show/{id}',[PostController::class,'show']);

        Route::put('update/{id}',[PostController::class,'update']);

        Route::post('delete/{id}',[PostController::class,'delete']);
        Route::post('retrieve',[PostController::class,'restorePosts']);
        Route::post('retrieve/post/{id}',[PostController::class,'restorePost']);
        //search
        Route::get('search/{type}',[SearchController::class ,'search']);

    });

    Route::post('logout',[AuthController::class ,'logout']);

});
