<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function GetAllCourse(){
        $data = Course::all();
        if($data){
            return response()->json(['data' =>  $data], 200); 
        }else{
            return response()->json(['data' =>  'null'], 201); 
        }
    }
}
