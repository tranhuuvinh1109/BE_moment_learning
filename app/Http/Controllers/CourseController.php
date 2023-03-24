<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\PurchasedCourse;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function GetAllCourse(){
        $courseData =  Course::with('plans')->with('lessons')->get();
        if($courseData){
            return response()->json(['data' =>  $courseData], 200); 
        }else{
            return response()->json(['data' =>  'null'], 201); 
        }
    }
    public function GetCourseDetail($id){
        $courseData =  Course::with('plans')->with('lessons')->findOrFail($id);
        if($courseData){
            return response()->json(['data' =>  $courseData], 200); 
        }else{
            return response()->json(['data' =>  'null'], 201); 
        }
    }
    public function RegisterCourse(Request $request){
        if($request){
            $data = PurchasedCourse::where('user_id', $request->userId)->where('course_id', $request->courseId)->get();
            if($data->count() > 0){
                return response()->json(['data' => 'data exist' ], 201); 
            }
            else{
                $purchasedCourse = new PurchasedCourse();
                $purchasedCourse -> user_id = $request->userId;
                $purchasedCourse -> course_id = $request->courseId;
                $purchasedCourse -> save();
                return response()->json(['data' =>  $purchasedCourse], 200); 
            }
        }
    }
    public function CheckRegistered(Request $request){
        if($request){
            $data = PurchasedCourse::where('user_id', $request->userId)->where('course_id', $request->courseId)->get();
            if($data->count() > 0){
                return response()->json(['data' => $data ], 200); 
            }
            else{
                return response()->json(['data' =>  'error'], 201); 
            }
        }
    }
}
