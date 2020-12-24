<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UploadsController;
use App\Http\Controllers\Api\ApiController;

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

Route::redirect('/', 'upload');

Auth::routes();

Route::get('/uploads', [UploadsController::class, 'index']);
Route::get('/upload', [PagesController::class, 'upload']);
Route::post('/upload/store', [UploadsController::class, 'store']);
Route::delete('/upload/delete/{id}', [UploadsController::class, 'delete']);
Route::get('/s/{slug}', [UploadsController::class, 'view']);

Route::get('/settings', [PagesController::class, 'viewSettings']);

Route::post('api/create', [ApiController::class, 'create']);
Route::delete('api/delete/{id}', [ApiController::class, 'delete']);

