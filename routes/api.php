<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EndPointsController;
use App\Http\Controllers\CustomDomainsController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [EndPointsController::class, 'info']);

Route::post('upload', [EndPointsController::class, 'storeUpload']);

Route::get('domains', [CustomDomainsController::class, 'index']);
Route::post('domains/store', [CustomDomainsController::class, 'store']);
Route::delete('domains/delete/{id}', [CustomDomainsController::class, 'delete']);

// Route::get('domains', function() {
//     return response()->json(['name' => 'Content Share', 'status' => '200'], 200);
// });