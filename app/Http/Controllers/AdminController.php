<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchasedCourse;

class AdminController extends Controller
{
    public function Daskboard() {
        $courseRegistrations = PurchasedCourse::select('course_id', \DB::raw('COUNT(*) as quantity'))
            ->with('course')
            ->groupBy('course_id')
            ->get();

        $result = [];

        foreach ($courseRegistrations as $registration) {
            $courseId = $registration->course_id;
            $quantity = $registration->quantity;
            $course = $registration->course;

            $result[] = [
                'course_id' => $courseId,
                'quantity' => $quantity,
                'course' => $course
            ];
        }

        
        return response()->json(['data' => $result], 200);
    }
}
