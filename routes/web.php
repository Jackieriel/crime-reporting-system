<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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

// Route::get('/former', function () {
//     return view('welcome');
// });

Route::get('/', 'FrontendController@index')->name('index');

// Route::get('/', 'FrontendController@index')->name('index');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'FrontendController@dashboard')->name('dashboard');
    Route::resource('incident', 'IncidentController');

    Route::get('/user/edit/{id}', 'UserController@userRole')->name('user.edit');
});


Route::group(['middleware' => ['auth', 'securityAgency']], function () {
    Route::resource('crime-category', 'CrimeCategoryController');
    Route::resource('feedback', 'FeedbackController');
    Route::resource('announcement', 'AnnouncementController');
    Route::resource('agency', 'AgencyController');
    Route::get('/users', 'UserController@users')->name('users');
});


Route::group(['middleware' => ['auth', 'superAdmin']], function () {
    Route::resource('crime-category', 'CrimeCategoryController');
    Route::resource('feedback', 'FeedbackController');
    Route::resource('announcement', 'AnnouncementController');
    Route::resource('agency', 'AgencyController');

    

    Route::get('/users', 'UserController@users')->name('users');
    Route::get('/user/{id}', 'UserController@show')->name('user.show');

    Route::get('/roles/edit/{id}', 'UserController@userRole')->name('role.edit');
    Route::post('/roles/update/{id}', 'UserController@update')->name('role.update');

    Route::get('/user/delete/{id}', 'UserController@destroy')->name('user.destroy');


});

Route::group(['middleware' => ['auth', 'otherAgency']], function () {
//
});

Auth::routes();
