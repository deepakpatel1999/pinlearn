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

Route::post('/login', [App\Http\Controllers\ApiController::class, 'login'])->name('login');

// Route::post('/signup', [App\Http\Controllers\ApiController::class, 'signup'])->name('signup');


Route::group(['middleware' => ['auth:sanctum']], function () {
   // Route::get('/inspirationp-get-data', [App\Http\Controllers\ApiController::class, 'inspiration_get_data'])->name('inspiration-get-data');
});
