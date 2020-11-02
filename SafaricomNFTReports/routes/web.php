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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
	Route::get('list-user', 'AdminController@listAllUsers')->name('list-user');
});

Route::group(['middleware' => 'App\Http\Middleware\QEMiddleware'], function()
{
	Route::get('list-QE', 'QEController@listAllProjects')->name('list-QE');
	Route::get('/register', 'RegisterController@index')->name('register');
	Route::post('store_user', 'RegisterController@create')->name('store_user');
	Route::get('test_runs/{project_id}', 'QEController@showruns')->name('test_runs');
	Route::get('chart/{run_id}', 'ChartController@index')->name('chart');
	
});

Route::group(['middleware' => 'App\Http\Middleware\OtherMiddleware'], function()
{
	Route::get('list-Other', 'OtherController@listAllProjects')->name('list-Other');
	Route::get('summary/{project_id}', 'OtherController@summaryreport')->name('summary');
});
