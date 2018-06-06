<?php

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
Route::get('/', 'TopicsController@index')->name('root');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//资源路由
Route::resource('users','UsersController',['only' => ['show','update','edit']]);

Route::resource('topics', 'TopicsController', ['only' => ['index','create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

Route::resource('categories','CategoriesController',['only' => ['show']]);

Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
Route::get('upload', 'UploadController@index')->name('index');

//测试百度翻译
Route::get('baidu/{text}','BaiduController@index');

//发表和删除话题
Route::resource('replies', 'RepliesController', ['only' => ['store','destroy']]);

//消息通知
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');

//测试cookie
Route::get('cookie','Admin\CookieController@index')->name('index');

//秒杀测试
Route::group(['prefix' => 'orders'], function ()
{
//    Route::get('/', 'OrderController@index');
    Route::get('/spike', 'OrderController@spike');
    Route::get('/spike/run', 'OrderController@run');
//    Route::post('/store', 'OrderController@store');
//    Route::put('/{id}/update', 'OrderController@update');
//    Route::patch('/{id}/patch', 'OrderController@patch');
//    Route::delete('/{id}/destroy', 'OrderController@destroy');
});

//student

Route::namespace('Admin')->group(function () {
    Route::group(['prefix' => 'student'],function(){
		 Route::get('index','StudentController@index');
		 Route::post('store','StudentController@store')->name('add');
		 Route::get('show','StudentController@show')->name('show');
	});
});

Route::group(['prefix' => 'swagger'], function () {
    Route::get('json', 'SwaggerController@getJSON');
    Route::get('my-data', 'SwaggerController@getMyData');
});


