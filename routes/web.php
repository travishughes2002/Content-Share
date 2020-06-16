<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

// Upload stuff
Route::get('/home', 'HomeController@index');
Route::post('/upload', 'UploadController@store');
Route::get('/uploads', 'UploadController@viewUploads');
Route::get('/uploads/delete/{id}', 'UploadController@deleteImage');
Route::get('/i/{slug}', 'UploadController@viewImageViaSlug');

Route::get('/settings', 'SettingsController@viewSettingsPage');

// API stuff
Route::post('/settings/api/create', 'ApiController@createApiKey');
Route::get('/settings/api/delete/{id}', 'ApiController@deleteApiKey');
Route::get('/api/test', 'ApiController@apiTest')->middleware('ApiAuthentication');

// Custom Domain stuff
Route::post('/settings/domain/add', 'DomainsController@addDomain');
Route::get('/settings/domain/delete/{id}', 'DomainsController@deleteDomain');