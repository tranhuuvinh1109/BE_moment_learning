<?php

namespace App\Http\Controllers;
// use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['Login']]);
    }
    public function Me()
    {
        $jwt = JWTAuth::parseToken();
        $user = $jwt->authenticate();
        if($user){
            return response()->json(['data' => $user], 200);
        }else{
            return response()->json(['message' => 'get information error'], 401);
        }
    }
    public function Login(Request $request){
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'data' => $user,
            'expires_in' => auth()->factory()->getTTL() * 60,

        ], 200);
        // $arr = [
        //     'email'=> $request->email, 'password'=> $request->password
        // ];
        // if(Auth::attempt($arr)){
        //     $user = Auth::user();
        //     return response()->json(['data' =>  $user], 200); 
        // }else
        // {
        //     return response()->json(['data' => 'wrong account and password' ], 201); 
        // }
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
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], 200);
    }
}
