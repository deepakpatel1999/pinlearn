<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\users\UsersController;
use App\Http\Controllers\API\users\GradeController;
use App\Http\Controllers\API\users\CategoryController;
use App\Http\Controllers\API\users\SubjectController;
use App\Http\Controllers\API\users\TopicController;
use App\Http\Controllers\API\users\CourseController;
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

Route::post('/login', [UsersController::class, 'login'])->name('login');

Route::post('/signup', [UsersController::class, 'signup'])->name('signup');

Route::get('/tutor-get-data', [UsersController::class, 'tutor_get_data'])->name('tutor-get-data');

Route::get('/user-get-data', [UsersController::class, 'user_get_data'])->name('user-get-data');

Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit');

Route::post('/user-update-data', [UsersController::class, 'user_update_data'])->name('user-update-data');

Route::get('/delete-data/{id}', [UsersController::class, 'delete_data'])->name('delete-data');

Route::get('/gtade-get-data', [GradeController::class, 'gtade_get_data'])->name('gtade-get-data');

Route::post('/grade-insert', [GradeController::class, 'grade_insert'])->name('grade-insert');

Route::get('/grade-edit/{id}', [GradeController::class, 'grade_edit'])->name('grade-edit');

Route::post('/grade-update-data', [GradeController::class, 'grade_update_data'])->name('grade-update-data');

Route::get('/delete-grade/{id}', [GradeController::class, 'delete_grade'])->name('delete-grade');

Route::post('/category-insert', [CategoryController::class, 'category_insert'])->name('category-insert');

Route::get('/category-get-data', [CategoryController::class, 'category_get_data'])->name('category-get-data');

Route::get('/category-edit/{id}', [CategoryController::class, 'category_edit'])->name('category-edit');

Route::post('/category-update-data', [CategoryController::class, 'category_update_data'])->name('category-update-data');

Route::get('/delete-category/{id}', [CategoryController::class, 'delete_category'])->name('delete-category');

Route::post('/subject-insert', [SubjectController::class, 'subject_insert'])->name('subject-insert');

Route::get('/subject-get-data', [SubjectController::class, 'subject_get_data'])->name('subject-get-data');

Route::get('/subject-edit/{id}', [SubjectController::class, 'subject_edit'])->name('subject-edit');

Route::post('/subject-update-data', [SubjectController::class, 'subject_update_data'])->name('subject-update-data');

Route::get('/delete-subject/{id}', [SubjectController::class, 'delete_subject'])->name('delete-subject');

Route::get('/topic-get-data', [TopicController::class, 'topic_get_data'])->name('topic-get-data');

Route::post('/topic-insert', [TopicController::class, 'topic_insert'])->name('topic-insert');

Route::get('/topic-edit/{id}', [TopicController::class, 'topic_edit'])->name('topic-edit');

Route::post('/topic-update-data', [TopicController::class, 'topic_update_data'])->name('topic-update-data');

Route::get('/topic-delete/{id}', [TopicController::class, 'delete_topic'])->name('topic-delete');

Route::post('/course-insert', [CourseController::class, 'course_insert'])->name('course-insert');

Route::post('/add-section', [CourseController::class, 'add_section'])->name('add-section');

Route::post('/add-lecture', [CourseController::class, 'add_lecture'])->name('add-lecture');

Route::post('/course-coupon', [CourseController::class, 'course_coupon'])->name('course-coupon');

Route::get('/get-course', [CourseController::class, 'get_course'])->name('get-course');

Route::group(['middleware' => ['auth:sanctum']], function () {


});
