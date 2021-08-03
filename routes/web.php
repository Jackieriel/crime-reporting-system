<?php

use App\Http\Controllers\FrontendController;
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

Route::get('/news',  'FrontendController@news')->name('news');
Route::get('/news/{id}',  'FrontendController@singleNews')->name('news.show');

Route::get('/crime-types', 'FrontendController@typeOfCrimes')->name('crime.types');

Route::get('/incidents-results', 'IncidentController@searchIncident')->name('incident.search');



// Normal user
Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'FrontendController@dashboard')->name('dashboard');
    Route::get('/report', 'FrontendController@reportCase')->name('report');
    

    Route::post('report', 'FrontendController@report')->name('report.store');

    Route::get('reported-cases', 'FrontendController@reportedCases')->name('report.cases');
    Route::get('/report/{id}', 'FrontendController@singleReport')->name('report.show');

    Route::get('/my-stat', 'FrontendController@userStat')->name('user.stat');

    Route::get('/profile/edit/{id}', 'FrontendController@editProfile')->name('profile.edit');
    Route::post('/profile/update/{id}', 'FrontendController@updateProfile')->name('profile.update');
    
    Route::get('/profile/{id}', 'FrontendController@Profile')->name('user.profile');

});


Route::group(['middleware' => ['auth', 'securityAgency','verified']], function () {
    Route::resource('crime-category', 'CrimeCategoryController');
    Route::resource('feedback', 'FeedbackController');
    Route::resource('announcement', 'AnnouncementController');
    Route::resource('agency', 'AgencyController');
    Route::get('/users', 'UserController@users')->name('users');
    Route::resource('incident', 'IncidentController');
});


Route::group(['middleware' => ['auth', 'superAdmin', 'verified']], function () {
// Route::group(['middleware' => ['auth', 'superAdmin']], function () {
    Route::resource('crime-category', 'CrimeCategoryController');
    Route::resource('feedback', 'FeedbackController');
    Route::resource('announcement', 'AnnouncementController');
    Route::resource('agency', 'AgencyController');
    Route::resource('incident', 'IncidentController');

    

    Route::get('/crime-stats', 'IncidentController@crimeStats')->name('crime.stats');

    // Route::get('/chart-view', 'FrontendController@statsChart')->name('stats.chart');


    Route::get('/users', 'UserController@users')->name('users');
    Route::get('/user/{id}', 'UserController@show')->name('user.show');

    Route::get('/roles/edit/{id}', 'UserController@userRole')->name('role.edit');
    Route::post('/roles/update/{id}', 'UserController@update')->name('role.update');

    Route::get('/user/delete/{id}', 'UserController@destroy')->name('user.destroy');


});

Route::group(['middleware' => ['auth', 'otherAgency', 'verified']], function () {
//
});

Auth::routes(['verify' => true]);
