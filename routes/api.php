<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController as AuthControllerCustom;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[AuthControllerCustom::class, 'Login']);
Route::get('/me/{id}',[AuthControllerCustom::class, 'Me']);
Route::post('/register',[AuthControllerCustom::class, 'Register']);
Route::get('/user/{id}',[AuthControllerCustom::class, 'GetInformationUser']);



Route::get('/member',[UserController::class, 'GetAllMember']);
Route::get('/teacher',[UserController::class, 'GetAllTeacher']);
Route::get('/search={query}',[CourseController::class, 'Search']);

Route::get('/course',[CourseController::class, 'GetAllCourse']);
Route::get('/course/{id}',[CourseController::class, 'GetCourseDetail']);
Route::post('/course/{id}',[CourseController::class, 'UpdateCourse']);
Route::delete('/course/{id}',[CourseController::class, 'DeleteCourse']);
Route::post('/course',[CourseController::class, 'CreateCourse']);


Route::post('/purchased_course',[CourseController::class, 'RegisterCourse']);
Route::post('/check_registered_course',[CourseController::class, 'CheckRegistered']);
