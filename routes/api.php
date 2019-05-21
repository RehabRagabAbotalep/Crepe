<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/users','Api\UserController');

Route::apiResource('/categories','Api\CategoryController');

Route::apiResource('/{category}/products','Api\ProductController');
Route::post('/signup','Api\UserController@signup');

Route::post('/login','Api\UserController@login');

Route::get('signup/activate/{token}', 'Api\UserController@signupActivate');

Route::group([       
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'Api\PasswordResetController@create');
    Route::get('find/{token}', 'Api\PasswordResetController@find');
    Route::post('reset', 'Api\PasswordResetController@reset');
});
