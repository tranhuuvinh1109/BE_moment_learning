<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

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
    // public function Search($query){
    //     $teacher = User::where('name', 'like', "%$search%")->orWhere('email', 'like', "%$search%")->get();
    //     if($teacher){
    //         return response()->json(['data'=> $teacher],200);
    //     }else{
    //         return response()->json(['data'=> 'error'],400);
    //     }
    // }
    public function search($keyword)
    {

        $blogs = Blog::where('title', 'LIKE', "%$keyword%")->get();

        $courses = Course::where('name', 'LIKE', "%$keyword%")->get();

        $users = User::where('name', 'LIKE', "%$keyword%")->get();

        return response()->json([
            'blogs' => $blogs,
            'courses' => $courses,
            'users' => $users
        ], 200);
    }
    public function EditProfile(Request $request){
        $user = User::find($request->id);
        if($user){
            $user->name = $request->name;
            $user->avatar = $request->avatar;
            $user->phone = $request->phone;
            if($user->save()){
                return response()->json(['data'=> $user,'message' => 'Edit profile succesfully'],200);
            }else{
                return response()->json(['data'=> $user,'message' => 'Edit profile fail'],400);
            }
        }else{
            return response()->json(['data'=> 'error'],400);
        }
    }
    public function changePassword(Request $request)
{
    $user = User::find($request->input('id'));

    if ($user) {
        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');

        // Kiểm tra mật khẩu hiện tại của người dùng
        if (Hash::check($currentPassword, $user->password)) {
            // Mật khẩu hiện tại khớp

            // Mã hóa mật khẩu mới bằng bcrypt
            $hashedPassword = Hash::make($newPassword);

            // Cập nhật mật khẩu mới cho người dùng
            $user->password = $hashedPassword;

            if ($user->save()) {
                return response()->json(['message' => 'Password changed successfully'], 200);
            } else {
                return response()->json(['message' => 'Failed to change password'], 400);
            }
        } else {
            // Mật khẩu hiện tại không khớp
            return response()->json(['message' => 'Current password is incorrect'], 400);
        }
    } else {
        // Người dùng không tồn tại
        return response()->json(['message' => 'User not found'], 404);
    }
}
}
