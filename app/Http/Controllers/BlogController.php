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
}
