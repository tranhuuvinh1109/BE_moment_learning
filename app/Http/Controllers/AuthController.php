<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Me($id)
    {
        $user = User::findOrFail($id);
        if($user){
            return response()->json(['data' => $user], 200);
        }else{
            return response()->json(['message' => 'get information error'], 401);
        }
    }
    public function Login(Request $request){

        $arr = [
            'email'=> $request->email, 'password'=> $request->password
        ];
        if(Auth::attempt($arr)){
            $user = Auth::user();
            return response()->json(['data' =>  $user], 200); 
        }else
        {
            return response()->json(['data' => $arr ], 201); 
        }
    }
    public function GetInformationUser($id){
        $data = User::with('PurchasedCourse')->where('id', $id)->first();
        if($data){
            return response()->json(['data' =>  $data], 200); 
        }else
        {
            return response()->json(['data' => 'wrong account and password' ], 201); 
        }
    }
    protected function Register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->avatar = $request->avatar;
        $user->phone = $request->phone;

        if ($user->save()) {
            return response()->json(['message' => 'Register successfully'], 200);
        } else {
            return response()->json(['message' => 'fail'], 500);
        }
    } 
    
}
