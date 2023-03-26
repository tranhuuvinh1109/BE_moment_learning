<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function GetAllMember(){
        $member = User::where('role', 0)->get();
        if($member){
            return response()->json(['data'=> $member],200);
        }else{
            return response()->json(['data'=> 'error'],400);
        }
    }
    public function GetAllTeacher(){
        $teacher = User::where('role', 1)->get();
        if($teacher){
            return response()->json(['data'=> $teacher],200);
        }else{
            return response()->json(['data'=> 'error'],400);
        }
    }
    public function Search($query){
        $teacher = User::where('name', 'like', "%$query%")->orWhere('email', 'like', "%$query%")->get();;
        if($teacher){
            return response()->json(['data'=> $teacher],200);
        }else{
            return response()->json(['data'=> 'error'],400);
        }
    }
}
