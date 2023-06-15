<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController as AuthControllerCustom;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MailController;


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

Route::get('/me', [AuthControllerCustom::class, 'Me']);

Route::post('/login',[AuthControllerCustom::class, 'Login']);
Route::get('/login/email={email}&password={password}',[AuthControllerCustom::class, 'GetLogin']);
// Route::get('/me/{id}',[AuthControllerCustom::class, 'Me']);
Route::post('/register',[AuthControllerCustom::class, 'Register']);
Route::get('/user/{id}',[AuthControllerCustom::class, 'GetInformationUser']);
Route::post('/user/edit',[UserController::class, 'EditProfile']);
Route::post('/user/change_pass',[UserController::class, 'changePassword']);
Route::post('/send-mail',[MailController::class, 'sendMailPayment']);
Route::get('/send-mail/email={email}&course={course}&price={price}&image={image}',[MailController::class, 'sendMailPaymentGet']);
Route::post('/register-response',[MailController::class, 'sendMailRegisterResponse']);



Route::get('/member',[UserController::class, 'GetAllMember']);
Route::get('/blog',[BlogController::class, 'GetAllBlog']);
Route::get('/blog/{id}',[BlogController::class, 'GetBlogById']);
Route::get('/teacher',[UserController::class, 'GetAllTeacher']);
Route::get('/search/keyword={keyword}',[UserController::class, 'search']);

Route::get('/course',[CourseController::class, 'GetAllCourse']);
Route::get('/category',[CategoryController::class, 'GetAll']);
Route::get('/course/{id}&user_id={user_id}',[CourseController::class, 'GetCourseDetail']);
Route::post('/course/{id}',[CourseController::class, 'UpdateCourse']);
Route::delete('/course/{id}',[CourseController::class, 'DeleteCourse']);
Route::post('/course',[CourseController::class, 'CreateCourse']);


Route::post('/purchased_course',[CourseController::class, 'RegisterCourse']);
Route::get('/purchased_course/course_id={course_id}&user_id={user_id}',[CourseController::class, 'RegisterCourseGet']);
Route::post('/check_registered_course',[CourseController::class, 'CheckRegistered']);
Route::post('/test', [MailController::class, 'Test']);
Route::get('/test/{id}', [MailController::class, 'GetTest']);
