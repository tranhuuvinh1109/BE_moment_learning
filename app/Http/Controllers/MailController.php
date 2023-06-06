<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendEmailUsingGmail;
// use App\Mail\SendMailRegister;
use App\Mail\SendMailRegister;

class MailController extends Controller
{
    public function sendMailPayment(Request $request)
    {
        $email = $request->input('email');
        $course = $request->input('course');
        $price = $request->input('price');
        $img = $request->input('img');
        
        Mail::to($email)->send(new SendEmailUsingGmail($email, $course, $price, $img));
        
        return response()->json(['data' => $request->email, 'course' => $request->course, 'price' => $request->price], 201); 
    }
    public function sendMailRegisterResponse(Request $request)
    {
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        
        Mail::to($email)->send(new SendMailRegister($email, $username, $password));
        
        return response()->json(['data' => $request->email, 'username' => $request->username], 201); 
    }
    public function Test (Request $request) {
        return response()->json(['data' => $request->email], 200); 
    }
    public function GetTest ($id) {
        return response()->json(['data' => $id], 200); 
    }
}
