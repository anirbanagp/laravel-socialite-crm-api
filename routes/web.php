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

Route::get('/test-api','ApiController@getContactDescription');

Route::get('/', ['as' => 'home', 'uses' => 'AuthenticationController@getLogin']);

Route::group(['as'=> 'auth.', 'middleware'=> 'guest'], function(){

    Route::get('/registration', ['as' => 'registration', 'uses' => 'AuthenticationController@getRegistration']);
    Route::post('/registration', ['as' => 'postRegistration', 'uses' => 'AuthenticationController@postRegistration']);

    Route::get('/login', ['as' => 'login', 'uses' => 'AuthenticationController@getLogin']);
    Route::post('/login', ['as' => 'postLogin', 'uses' => 'AuthenticationController@postLogin']);

    Route::post('/forgot-password', ['as' => 'forgotPassword', 'uses' => 'AuthenticationController@sendForgotPasswordLink']);
    Route::get('/reset-password/{token}', ['as'=> 'resetPassword', 'uses'=>'AuthenticationController@getResetPassword']);
    Route::post('/reset-password', ['as'=> 'postResetPassword', 'uses'=>'AuthenticationController@postResetPassword']);

    Route::group(['prefix'=> 'auth'], function(){
        Route::get('redirect/{provider}', ['as'=> 'redirect', 'uses'=>'AuthenticationController@redirectToProvider']);
        Route::get('callback/{provider}', ['as'=> 'callback', 'uses'=>'AuthenticationController@handleProviderCallback']);

        Route::get('verify-email/{token}', ['as'=> 'verifyEmail', 'uses'=>'AuthenticationController@getVerifyEmail']);

    });
});
Route::group(['middleware'=> 'auth'], function(){

    Route::post('/logout', ['as' => 'auth.logout', 'uses' => 'AuthenticationController@postLogout']);

    Route::group(['prefix'=> 'company', 'as' => 'company.'], function(){
        Route::get('profile', ['as'=> 'profile', 'uses'=>'CompanyController@getProfile']);
    });
    Route::group(['as' => 'user.'], function(){
        Route::get('edit-profile', ['as'=> 'editProfile', 'uses'=>'UserController@getEditProfile']);
        Route::post('edit-profile', ['as'=> 'updateProfile', 'uses'=>'UserController@postUpdateProfile']);
    });

});
