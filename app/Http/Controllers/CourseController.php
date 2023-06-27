<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\PurchasedCourse;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CourseRequest;

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

    public function CreateCourse(Request $request){
        // $user = User::findOrFail($request->teacher);
        if(true){
            $course = new Course();
            if($request){
                $course->name = $request->name;
                $course->teacher = $request->teacher;
                $course->category = 1;
                $course->price = $request->price;
                $course->image = $request->image;
                $course->description = $request->description;
                $course->save();
                if($course->wasRecentlyCreated){
                    if($course->id && $request->lessons && $request->plans){
                        $lesson_data = $request->lessons;
                        $plan_data = $request->plans;
                        // Tạo và lưu các bản ghi vào bảng lesson
                        $num_lessons_created = 0;
                        $num_plans_created = 0;
                        foreach ($lesson_data as $lesson_item) {
                            $lesson = new Lesson();
                            $lesson->course_id = $course->id;
                            $lesson->name = $lesson_item['name'];
                            if (isset($lesson_item['video'])) {
                                $lesson->video = $lesson_item['video'];
                            } else {
                                $lesson->video = null; // set default value
                            }
                            if (isset($lesson_item['grammar'])) {
                                $lesson->grammar = $lesson_item['grammar'];
                            } else {
                                $lesson->grammar = null; // set default value
                            }
                            if ($lesson->save()) {
                                $num_lessons_created++;
                            }
                        }
    
                        foreach ($plan_data as $plan_item) {
                            $plan = new Plan();
                            $plan->course_id = $course->id;
                            if (isset($plan_item['title'])) {
                                $plan->title = $plan_item['title'];
                            } else {
                                $plan->title = null; // set default value
                            }
                            
                            if ($plan->save()) {
                                $num_plans_created++;
                            }
                        }
        
                        if ($num_lessons_created == count($lesson_data) && $num_plans_created == count($plan_data)) {
                            $course_data = Course::with('lessons')->with('plans')->find($course->id);
                            return response()->json(['data' =>  $course_data, "plans" => $plan_data], 200); 
                        } else {
                            return response()->json(['data' =>  $request, 'message' => 'error lessons or plan'], 400); 
                        }
        
                    }
                }else{
                    return response()->json(['data' =>  $request, 'message' => 'error'], 400); 
                }
            }
        }else{
            return response()->json(['data' =>  $request, 'message' => 'you arenot teacher'], 400);
        }
    }
    
    public function DeleteCourse($id){
        $courseData =  $product = Course::find($id);
        $check = true;
        if($courseData){
            
            if ($courseData->delete()) {
                $data = Course::with('plans')->with('lessons')->get();
                return response()->json(['message' =>  'delete course successfully', 'data'=>$data], 200); 
            } else {
                return response()->json(['data' =>  'delete course fail'], 400); 
            }
            
        }else{
            return response()->json(['data' =>  'khong tim thay'], 400); 
        }
    }

    public function GetCourseDetail($id, $user_id){
        $courseData =  Course::with('plans')->with('lessons')->findOrFail($id);
        if($courseData){
            $purchasedCourse = PurchasedCourse::where('course_id', $id)
            ->where('user_id', $user_id)
            ->exists();
            $courseData->check_purchased_course = $purchasedCourse;
            return response()->json(['data' =>  $courseData], 200); 
        }else{
            return response()->json(['message' => 'Get data course fail'], 400); 
        }
    }

    public function UpdateCourse(Request $request, $id){
        $course = Course::findOrFail($id);
        if($course){
            if($request){
                $course->name = $request->name;
                $course->teacher = $request->teacher;
                $course->category = $request->category;
                $course->price = $request->price;
                $course->description = $request->description;
                if($request->lessons){
                    foreach ($request->lessons as $lesson_item) {
                        $lesson = Lesson::findOrFail($lesson_item['id']);
                        $lesson->name = $lesson_item['name'];
                        if (isset($lesson_item['video'])) {
                            $lesson->video = $lesson_item['video'];
                        } else {
                            $lesson->video = null;
                        }
                        if (isset($lesson_item['grammar'])) {
                            $lesson->grammar = $lesson_item['grammar'];
                        } else {
                            $lesson->grammar = null;
                        }
                        $lesson->save();
                    }
                }
                if($request->plans){
                    foreach ($request->plans as $plan_item) {
                        $plan = Plan::findOrFail($plan_item['id']);
                        if (isset($plan_item['title'])) {
                            $plan->title = $plan_item['title'];
                        } else {
                            $plan->title = null;
                        }
                        $plan->save();
                    }
                }
                $course->save();
                $courseData =  Course::with('plans')->with('lessons')->findOrFail($request->id);
                return response()->json(['data' =>  $courseData], 200);
            }
        }else{
            return response()->json(['data' =>  'error'], 404); 
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
                if ($purchasedCourse->wasRecentlyCreated) {
                    return response()->json(['data' =>  $purchasedCourse], 200); 
                } else {
                    return response()->json(['data' =>  'insert error'], 400); 
                }
                
            }
        }
    }
    public function RegisterCourseGet(Request $request){
        $var = $request->query('var');
        if($var){
            $decodedString = base64_decode($var);
            $object = json_decode($decodedString, false);
            if($object->userId && $object->courseId){
                $data = PurchasedCourse::where('user_id', $object->userId)->where('course_id', $object->courseId)->get();
                if($data->count() > 0){
                    return response()->json(['data' => 'data exist' ], 201); 
                }
                else{
                    $purchasedCourse = new PurchasedCourse();
                    $purchasedCourse -> user_id = $object->userId;
                    $purchasedCourse -> course_id = $object->courseId;
                    $purchasedCourse -> save();
                    if ($purchasedCourse->wasRecentlyCreated) {
                        return response()->json(['data' =>  $purchasedCourse], 200); 
                    } else {
                        return response()->json(['message' =>  'Insert error'], 400); 
                    }
                }
            }
        }else{
            return response()->json(['message' => 'fail var'], 400);
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
    public function Search($param) {
        if($param){
            $data = Course::where('name', 'like', '%' . $param . '%')->get();
            if($data->count() > 0){
                return response()->json(['data' => $data , 'saerch' => $param ], 200); 
            }
                return response()->json(['data' =>  'error'], 400); 
        }
    }
}
