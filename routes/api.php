<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
Route::post('reset-password', 'Auth\ForgotPasswordController@sendPasswordResetLink');
Route::post('reset/password', 'Auth\ResetPasswordController@callResetPassword');

Route::group(['middleware' => 'auth:api'], function () {

    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('event', 'EventController@index')->name('event');
    Route::get('event/{event}', 'EventController@show')->name('event.show');
    Route::post('event', 'EventController@store')->name('event.store');
    Route::patch('event/{event}', 'EventController@update')->name('event.update');
    Route::delete('event/{event}', 'EventController@destroy')->name('event.destroy');

    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::get('profile/{profile}', 'ProfileController@show')->name('profile.show');
    Route::post('profile', 'ProfileController@store')->name('profile.store');
    Route::patch('profile/{profile}', 'ProfileController@update')->name('profile.update');
    Route::delete('profile/{profile}', 'ProfileController@destroy')->name('profile.destroy');

    Route::get('profile-cv/{profile}', 'ProfileController@showcv')->name('profile.cv.show');
    Route::post('profile-cv', 'ProfileController@storecv')->name('profile.cv.store');
    Route::patch('profile-cv/update/{profile}','ProfileController@updatecv')->name('profile.cv.update');

    Route::get('role', 'RoleController@index')->name('role');
    Route::get('role/{role}', 'RoleController@show')->name('role.show');
    Route::post('role', 'RoleController@store')->name('role.store');
    Route::patch('role/{role}', 'RoleController@update')->name('role.update');
    Route::delete('role/{role}', 'RoleController@destroy')->name('profile.destroy');

});





