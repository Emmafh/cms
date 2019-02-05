<?php

namespace App\Http\Controllers;
use App\Course;

class CourseController extends Controller
{
    /**
     * Get the list of all courses.
     *
     * @return json  
     */
    public function index()
    {
        $data = Course::all();
        return response()->json(['msg' => 'success', 'data' => $data], 200);
    }
}

