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
Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/test', function (Request $request) {
        return 'test';
    });

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

});
