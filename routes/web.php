<?php

use Illuminate\Support\Facades\Route;
// use Mail;
use App\Http\Controllers\MailController;
use App\Mail\SendEmailUsingGmail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/send', function () {
    Mail::to('tranhuudu113@gmail.com')->send(new SendEmailUsingGmail());
    return 'Mail sent';
});
Route::get('/test', function () {
    return response()->json(['data' => 'mail'], 200);
});
Route::post('/testaa', [MailController::class, 'Test']);

