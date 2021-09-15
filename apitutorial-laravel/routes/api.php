<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//all routes / api here must be api authenticated
Route::group(['middleware' => ['api','checkPassword','changeLanguage'], 'namespace' => 'Api'], function () {
    Route::post('get-main-categories', 'CategoriesController@index');
    Route::post('get-category-byId', 'CategoriesController@getCategoryById');
    Route::post('change-category-status', 'CategoriesController@changeStatus');

    Route::group(['prefix' => 'admin','namespace'=>'Admin'],function (){
        Route::post('login', 'AuthController@login');
        
        //invalidate token security side
        //broken access controller user enumeration
        Route::post('logout','AuthController@logout')->middleware(['auth.guard:admin-api']);
    });

    Route::group(['prefix' => 'user' ,'middleware' => 'auth.guard:user-api'],function (){
        Route::post('profile',function(){
            return 'Only authenticated user can reach me';
        }) ;
     });

});


Route::group(['middleware' => ['api','checkPassword','changeLanguage','checkAdminToken:admin-api'], 'namespace' => 'Api'], function () {
    Route::get('offers', 'CategoriesController@index');
});