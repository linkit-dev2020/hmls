<?php

namespace App\Http\Controllers;

use App\Advice;
use App\ClassRoom;
use App\ClassStudent;
use App\Course;
use App\Lesson;
use App\Note;
use App\Subject;
use App\Test;
use App\Unit;;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentDashboard extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->active==0) return redirect('/wait');
        $classes=ClassRoom::all()->sortBy('order_num');
        $courses=Course::all()->sortBy('order_num');
        $check=false;
        return view('stdashboard.home',compact('classes','courses','check'));
    }
    public function myclasses(Request $request)
    {
        if(Auth::user()->active==0) return redirect('/wait');
        $user_id = auth()->user()->id;
        $student_classes = DB::table('class_student')->where('student_id', $user_id)->get();
        $classes = array();
        foreach ($student_classes as $classObj) {
            $studentClass = ClassRoom::find($classObj->class_id);
            array_push($classes, $studentClass);
        }

        $student_courses = DB::table('course_student')->where('student_id', $user_id)->get();
        $courses = array();
        foreach ($student_courses as $classObj) {
            $studentClass = Course::find($classObj->course_id);
            array_push($courses, $studentClass);
        }
        if (request()->expectsJson())
        {
            return $classes;
        }
        $check=true;
        return view('stdashboard.home',compact('classes','courses','check'));
    }

    public function showMyClass(Request $request,$id)
    {
        if(Auth::user()->active==0) return redirect('/wait');
        $class = ClassRoom::find($request->id);
        $denemes  = $class->denemes;
        $subjects = $class->subjects->sortBy('order_num') ;
        $notes = Note::query()->where('class_id' , $class->id)->where('type', 'private')->get();
        return view('stdashboard.myclass', compact('subjects', 'class', 'denemes','notes'));
    }

    public function showSubject($cid,$uid,$lid)
    {
        if(Auth::user()->active==0) return redirect('/wait');
        // security check needed here

        $subject=Subject::find($cid);

        if($subject==null||!$this->checkUserClass($subject->id,Auth::user()->id)||$subject->active==0)
            return abort(403);
        $unit1=Unit::find($uid);
        $lesson=Lesson::find($lid);
        return view('stdashboard.show',compact('subject','lesson','unit1'));
    }

    public function showSubjectMain($cid)
    {
        if(Auth::user()->active==0)
            return redirect('/wait');
        // security check needed here

        $subject=Subject::find($cid);
        if($subject==null||!$this->checkUserClass($subject->class->id,Auth::user()->id))
            return abort(403);
        return view('stdashboard.show',compact('subject'));
    }

    public function showCourse($cid)
    {
        if(Auth::user()->active==0) return redirect('/wait');
        // security check needed here

        $course=Course::find($cid);
        //if($subject==null||!$this->checkUserClass($subject->class->id,Auth::user()->id))
          //  return abort(403);
        return view('stdashboard.showCourse',compact('course'));
    }

    public function showTest($cid,$tid)
    {
        $subject=Subject::find($cid);
        //if($subject==null||!$subject->class->students->where('id',Auth::user()->id)->count()) return redirect('/stdsh/myclasses');
        $test=Test::find($tid);
        return view('stdashboard.showTest',compact('subject','test'));
    }

    public function showTestCourse($cid,$tid)
    {
        $course=Course::find($cid);
        if(!checkForCoursePermissions($cid))
        {
            return redirect()->back();
        }
       // if($subject==null||!$subject->class->students->where('id',Auth::user()->id)->count()) return redirect('/stdsh/myclasses');
        $test=Advice::find($tid);
        return view('stdashboard.showTestCourse',compact('course','test'));
    }
    public function checkForCoursePermissions($cid){
        $user=Auth::user();
        // always allow admins to enter dashboard
        if($user->hasRole(0)||$user->hasRole(2))
            return true;
        $sid=\Illuminate\Support\Facades\Auth::user()->id;
        $a=\App\CourseStudent::where('student_id',$sid)->where('course_id',$cid)->first();
        $new=true;
        if($a!==null&&$a->count()>0)
        {
            $new=false;
        }
        return !$new;
    }
    public function checkUserClass($cid,$sid)
    {
        return true;
        if(Auth::user()->hasAnyRole([0,1]))
            return true;
        $st=ClassStudent::where('student_id',$sid)->where('class_id',$cid)->first();
        //echo "<script>alert(".$st.");</script>";
        if($st==null || $st->count()==0)
            return false;
        return true;
    }

    public function showCourseLesson($cid,$lid)
    {
        $course=Course::find($cid);
        $lesson=Lesson::find($lid);
        return view('stdashboard.showCourse',compact('course','lesson'));
    }
}
