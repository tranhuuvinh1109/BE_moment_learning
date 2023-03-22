<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function GetAllCourse(){
        $data =  DB::table('course')->get();
        // $data = Course::all();
        if($data){
            return response()->json(['data' =>  $data], 200); 
        }else{
            return response()->json(['data' =>  'null'], 201); 
        }
    }
}
