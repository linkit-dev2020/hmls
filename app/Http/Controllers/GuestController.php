<?php

namespace App\Http\Controllers;

use App\ClassRoom;
use App\Course;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    public function showCourses($id)
    {
        $class=ClassRoom::find($id);
        return view('stdashboard.courses',compact('class'));
    }


}
