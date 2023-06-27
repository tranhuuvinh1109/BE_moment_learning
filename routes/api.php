<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController as AuthControllerCustom;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdminController;


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

// Me($token)
Route::get('/me&token={token}',[AuthControllerCustom::class, 'Me']);

Route::post('/login',[AuthControllerCustom::class, 'Login']);
Route::get('/login',[AuthControllerCustom::class, 'GetLogin']);
// Route::get('/me/{id}',[AuthControllerCustom::class, 'Me']);
Route::post('/register',[AuthControllerCustom::class, 'Register']);
Route::get('/user/{id}',[AuthControllerCustom::class, 'GetInformationUser']);
Route::get('/user_profile/update&id={id}&fullname={fullname}&phone={phone}&address={address}&birthday={birthday}&avatar={avatar}',[UserController::class, 'EditProfileGet']);
Route::post('/user/change_pass',[UserController::class, 'changePassword']);
Route::post('/send-mail',[MailController::class, 'sendMailPayment']);
Route::get('/send-mail',[MailController::class, 'sendMailPaymentGet']);
Route::post('/register-response',[MailController::class, 'sendMailRegisterResponse']);


Route::middleware(['auth:sanctum'])->prefix('user')->group(function () 
{
    Route::get('/profile/edit',[UserController::class, 'EditProfileGet']);
    Route::post('/profile/edit',[UserController::class, 'EditProfile']);
});



Route::get('/member',[UserController::class, 'GetAllMember']);

Route::get('/blog',[BlogController::class, 'GetAllBlog']);
Route::get('/blog/create',[BlogController::class, 'CreateBlogGet']);
Route::get('/blog/edit',[BlogController::class, 'EditBlogGet']);
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
Route::get('/purchased_course',[CourseController::class, 'RegisterCourseGet']);
Route::post('/check_registered_course',[CourseController::class, 'CheckRegistered']);
Route::post('/test', [MailController::class, 'Test']);
Route::get('/test', [MailController::class, 'getTest']);

Route::get('/daskboard',[AdminController::class, 'Daskboard']);
