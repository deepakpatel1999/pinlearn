<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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

Route::post('/login', [ApiController::class, 'login'])->name('login');

Route::post('/signup', [App\Http\Controllers\ApiController::class, 'signup'])->name('signup');

Route::get('/tutor-get-data', [ApiController::class, 'tutor_get_data'])->name('tutor-get-data');

Route::get('/user-get-data', [ApiController::class, 'user_get_data'])->name('user-get-data');

Route::get('/edit/{id}', [ApiController::class, 'edit'])->name('edit');

Route::post('/user-update-data', [ApiController::class, 'user_update_data'])->name('user-update-data');

Route::get('/delete-data/{id}', [ApiController::class, 'delete_data'])->name('delete-data');

Route::get('/gtade-get-data', [ApiController::class, 'gtade_get_data'])->name('gtade-get-data');

Route::post('/grade-insert', [ApiController::class, 'grade_insert'])->name('grade-insert');

Route::get('/grade-edit/{id}', [ApiController::class, 'grade_edit'])->name('grade-edit');

Route::post('/grade-update-data', [ApiController::class, 'grade_update_data'])->name('grade-update-data');

Route::get('/delete-grade/{id}', [ApiController::class, 'delete_grade'])->name('delete-grade');

Route::post('/category-insert', [ApiController::class, 'category_insert'])->name('category-insert');

Route::get('/category-get-data', [ApiController::class, 'category_get_data'])->name('category-get-data');

Route::get('/category-edit/{id}', [ApiController::class, 'category_edit'])->name('category-edit');

Route::post('/category-update-data', [ApiController::class, 'category_update_data'])->name('category-update-data');

Route::get('/delete-category/{id}', [ApiController::class, 'delete_category'])->name('delete-category');

Route::post('/subject-insert', [ApiController::class, 'subject_insert'])->name('subject-insert');

Route::get('/subject-get-data', [ApiController::class, 'subject_get_data'])->name('subject-get-data');

Route::get('/subject-edit/{id}', [ApiController::class, 'subject_edit'])->name('subject-edit');

Route::post('/subject-update-data', [ApiController::class, 'subject_update_data'])->name('subject-update-data');

Route::group(['middleware' => ['auth:sanctum']], function () {


});
