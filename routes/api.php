<?php

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

Route::group(['as' => 'api:'], function() {

    # Auth
    Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
        Route::post('auth/login', ['as' => 'login', 'uses' => 'LoginController@index']);
        Route::post('auth/registration', ['as' => 'registration', 'uses' => 'RegistrationController@index']);
    });


    # Only Auth
    Route::group(['middleware' => 'auth:airlock'], function () {

        # User
        Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
            Route::get('users', ['as' => 'list', 'uses' => 'ListController@index']);
            Route::get('user/{user}', ['as' => 'getById', 'uses' => 'ViewController@getById'])->where('user', '[0-9]+');
            Route::get('user/me', ['as' => 'me', 'uses' => 'ViewController@me']);
            Route::put('user/update', ['as' => 'update', 'uses' => 'UpdateController@index']);

            Route::group(['namespace' => 'Avatar', 'as' => 'avatar.'], function () {
                Route::put('user/avatar/update', ['as' => 'update', 'uses' => 'UpdateController@index']);
            });

            Route::group(['namespace' => 'Request', 'as' => 'request.'], function () {
                Route::put('user/request/update', ['as' => 'update', 'uses' => 'UpdateController@index']);
            });

            Route::group(['namespace' => 'Expertise', 'as' => 'expertise.'], function () {
                Route::put('user/expertise/update', ['as' => 'update', 'uses' => 'UpdateController@index']);
            });
        });

        # Practice
        Route::group(['namespace' => 'Practice', 'as' => 'practice.'], function () {
            Route::get('practices', ['as' => 'list', 'uses' => 'ListController@index']);
            Route::get('practice/categories', ['as' => 'categories', 'uses' => 'ListController@categories']);
            Route::post('practice/create', ['as' => 'create', 'uses' => 'CreateController@index']);
            Route::put('practice/update/{practice}', ['as' => 'update', 'uses' => 'UpdateController@index']);
        });

        # File
        Route::group(['namespace' => 'File', 'as' => 'file.'], function () {
            Route::post('file/image', ['as' => 'image.upload', 'uses' => 'ImageController@upload']);
        });
    });

});
