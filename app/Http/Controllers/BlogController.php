<?php

namespace App\Http\Controllers;
use App\Models\Blog;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    function GetAllBlog() {
        $blogs = Blog::with('user')->get();
        if($blogs) {
            return response()->json(['data' => $blogs ], 200); 
        }else{
            return response()->json(['message' => 'Get all blog fail' ], 400); 
        }
    }
    function GetBlogById($id) {
        $blog = Blog::with('user')->find($id);
        if($blog) {
            return response()->json(['data' => $blog ], 200); 
        }else{
            return response()->json(['message' => 'Get all blog fail' ], 400); 
        }
    }
    function CreateBlogGet(Request $request) {
        $var = $request->query('var');
        dd(urldecode($var));
        // if ($var) {
        //     $decodedString = base64_decode(urldecode($var));
        //     $object = json_decode($decodedString);
        //     if ($object && isset($object->creator)) {
        //         $blog = new Blog();
        //         $blog->user_id = $object->creator;
        //         $blog->title = $object->title;
        //         $blog->image = $object->image;
        //         $blog->content = $object->content;
        //         if ($blog->save()) {
        //             return response()->json(['message' => 'Create Blog successfully', 'data' => $blog], 200);
        //         } else {
        //             return response()->json(['message' => 'fail'], 400);
        //         }
        //     }
        // }else{
        //     return response()->json(['message' => 'fail var', 'data' => $var], 400);
        // }
    }
    
    
    function EditBlogGet(Request $request) {
        $var = $request->query('var');
        if($var){
            $decodedString = base64_decode($var);
            $object = json_decode($decodedString, false);
            if($object->userId && $object->id){
                $blog = Blog::findOrFail($object->id);
                $blog->user_id = $object->userId;
                $blog->title = $object->title;
                $blog->image = $object->image;
                $blog->content = $object->content;
                if($blog->save()){
                    return response()->json(['message' => 'Update Blog successfully', 'data' => $blog], 200);
                }else{
                    return response()->json(['message' => 'fail'], 400);
                }
            }
        }else{
            return response()->json(['message' => 'fail var'], 400);
        }
    }
}
