<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Login(Request $request){
        $arr = [
            'email'=> $request->email, 'password'=> $request->password
        ];
        if(Auth::attempt($arr)){
            $user = Auth::user();
            return response()->json(['data' =>  $user], 200); 
        }else
        {
            return response()->json(['data' => 'wrong account and password' ], 201); 
        }
    }
}
