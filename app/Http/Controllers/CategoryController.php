<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    protected function GetAll() {
        $data = Category::all();
        if($data){
            return response()->json(['data'=> $data],200);
        }else{
            return response()->json(['data'=> 'error'],400);
        }
    }
}
