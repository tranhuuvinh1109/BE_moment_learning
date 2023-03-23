<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Lesson;
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
}
