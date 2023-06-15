<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function Me($token)
    {
        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            // Token không tồn tại
            return response()->json([
                'success' => false,
                'message' => 'Invalid token',
            ], 401);
        }

        $user = $personalAccessToken->tokenable;

        if (!$user instanceof User) {
            // Người dùng không tồn tại hoặc không hợp lệ
            return response()->json([
                'success' => false,
                'message' => 'Invalid user',
            ], 401);
        }

        if ($user->id) {
            $blog = User::with('blogs')->where('id', '=', $user->id)->get();
            $user->blogs = $blog[0]->blogs;
        }

        // Người dùng hợp lệ
        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);
    }


    public function Login(Request $request)
    {

        $arr = [
            'email' => $request->email, 'password' => $request->password
        ];
        if (Auth::attempt($arr)) {
            $user = Auth::user();
            return response()->json(['data' =>  $user], 200);
        } else {
            return response()->json(['data' => $arr], 201);
        }
    }
    // public function GetLogin($email, $password)
    // {

    //     $arr = [
    //         'email' => $email, 'password' => $password
    //     ];
    //     if (Auth::attempt($arr)) {
    //         $user = Auth::user();
    //         $blog = User::with('blogs')->where('id', '=', $user->id)->get();
    //         $user->blogs = $blog[0]->blogs;
    //         return response()->json(['data' =>  $user], 200);
    //     } else {
    //         return response()->json(['data' => $arr], 201);
    //     }
    // }

    public function GetLogin($email, $password)
    {
        $arr = [
            'email' => $email, 'password' => $password
        ];
        if (Auth::attempt($arr)) {
            $user = Auth::user();
            $blog = User::with('blogs')->where('id', '=', $user->id)->get();
            $user->blogs = $blog[0]->blogs;

            // create token
            $token = $user->createToken('token-name')->plainTextToken;

            // return response
            return response()->json([
                'success' => true,
                'message' => 'User found',
                'data' => $user,
                'token' => $token
            ], 200);

            return response()->json(['data' =>  $user], 200);
        } else {
            return response()->json(['data' => $arr], 201);
        }
    }


    public function GetInformationUser($id)
    {
        $data = User::find($id);
        if ($data) {
            return response()->json(['data' =>  $data], 200);
        } else {
            return response()->json(['data' => 'wrong account and password'], 201);
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
        $user->address = $request->address;
        $user->fullname = $request->fullname;

        if ($user->save()) {
            return response()->json(['message' => 'Register successfully'], 200);
        } else {
            return response()->json(['message' => 'fail'], 500);
        }
    }
}
