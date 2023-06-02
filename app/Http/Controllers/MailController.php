<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendEmailUsingGmail;

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
}
