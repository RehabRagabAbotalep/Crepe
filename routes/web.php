<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" Routes group. Now create something great!
|
*/



Auth::routes();

Route::get('/','HomeController@index');

/*Route::get('/home/{lang?}',function($lang=null){
	App::setlocale($lang);
	return view('layout.home');
});*/
	

Route::get('/home','ViewsController@index')->name('home');

Route::get('/signUp', 'ViewsController@signUp')->name('signUp');

Route::post('/register', 'UserController@register')->name('register');
Route::get('login/facebook','Auth\LoginController@redirectToProvider')->name('facebook.login');

Route::get('login/facebook/callback','Auth\LoginController@handleProviderCallback');

Route::get('/complete/register' , 'ViewsController@completeRegister')->name('register.complete');

//Verify Email
Route::get('/verify' , 'ViewsController@verifyEmail')->name('verify');
Route::get('/verify/{email}/{code}', 'UserController@sendEmailDone')->name('sendEmailDone');

//forgetPassword Route
Route::get('/forgetPassword','ViewsController@forgetPassword')->name('forgetPassword');
Route::post('/forget/Password' ,'ForgetPasswordController@forgetPassword')->name('sendCode');
Route::get('/send' ,'ViewsController@sendCode')->name('send');
Route::get('/send/{email}/{code}', 'ForgetPasswordController@sendCodeDone')->name('sendCodeDone');
Route::get('/code' ,'ViewsController@code')->name('code');
Route::post('/postCode','ForgetPasswordController@postCode')->name('postCode');
Route::get('/reset','ViewsController@reset')->name('reset');
Route::post('/resetPass','ForgetPasswordController@resetPass')->name('resetPass');
//
Route::post('/complete/register/{id}' , 'UserController@completeRegister')->name('register.complete');

Route::post('/login' ,'UserController@login')->name('login');

Route::get('/signIn', 'ViewsController@signIn')->name('signIn');

Route::get('/logout', 'UserController@logout')->name('logout');

//Address Route
Route::get('/address/create','AddressController@create')->name('address.create');
Route::post('/address/store','AddressController@store')->name('address.store');

//Admin Middleware
//Route::get('admin_area', ['middleware' => 'admin', function () {
    
	//Route::get('/', 'AdminController@admin')->name('admin');

	//User Routes
	Route::get('user/create', 'Admin\UserController@create')->name('user.create');
	Route::post('user/store', 'Admin\UserController@store')->name('user.store');
	Route::get('/users' , 'Admin\UserController@index')->name('users');
	Route::get('/user/delete/{id}', 'Admin\UserController@destroy')->name('user.delete');
	Route::get('/user/edit/{id}', 'Admin\UserController@edit')->name('user.edit');
	Route::post('/user/update/{id}','Admin\UserController@update')->name('user.update');

	//Category Routes
	Route::get('/category/create','Admin\CategoryController@create')->name('category.create');
	Route::post('/category/create','Admin\CategoryController@store')->name('category.store');
	Route::get('/categories','Admin\CategoryController@index')->name('categories');
	Route::get('/category/delete/{id}','Admin\CategoryController@delete')->name('category.delete');
	Route::get('/category/edit/{id}','Admin\CategoryController@edit')->name('category.edit');
	Route::post('/category/update/{id}','Admin\CategoryController@update')->name('category.update');

	//Products Route
	Route::get('/product/create','Admin\ProductController@create')->name('product.create');
	Route::post('/product/create','Admin\ProductController@store')->name('product.store');
	Route::get('/products','Admin\ProductController@index')->name('products');
	Route::get('/product/delete/{id}','Admin\ProductController@delete')->name('product.delete');
	Route::get('/product/edit/{id}','Admin\ProductController@edit')->name('product.edit');
	Route::post('/product/update/{id}','Admin\ProductController@update')->name('product.update');
//}]);
