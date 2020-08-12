<?php

namespace App\Http\Controllers;

use App\STest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentTest extends Controller
{
    //
    public function upload(Request $req)
    {


        if($req->hasFile('file'))
        {
            $student_id = $req->student_id;
            $subject_id = $req->subject_id;

            if($this->check($student_id,$subject_id))
            {
                return redirect()->back()->with('success','لقد قمت برفع حل مسبقا');
            }
            $url = $req->file->storeAs('public/tests', time().'-'.$subject_id.'-'.$student_id.'.'.$req->file->getClientOriginalExtension());
            $url = str_replace('public/','storage/',$url);
            $test = new STest();
            $test->url = $url;
            $test->student_id = $student_id;
            $test->subject_id = $subject_id;
            $test->save();

            return redirect()->back()->with('success','تم رفع الملف بنجاح');
        }
    }
    public function grade(Request $req)
    {
        $item = STest::where('student_id',$req->student_id)
        ->where('subject_id',$req->subject_id)
        ->get()
        ->first();

        $item->grade = $req->grade;
        $item->save();

        return redirect()->back()->with('success','تم تقييم الوظيفة بنجاح');
    }
    public function get()
    {
        $subs= Auth::user()->subjects;
        $tests = [];
        foreach ($subs as $sub)
        {
            foreach ($sub->tests as $test)
            {
                array_push($tests,$test);
            }
        }

        $st  = [] ;
        foreach($tests as $test)
        {
            $t = STest::where('subject_id',$test->id)->get();
            foreach($t as $item)
                array_push($st,$item);
        }

        return view('admin.tests.grades',compact('st'));

    }
    private function check($st,$sb)
    {
        $mod = STest::where('student_id',$st)->where('subject_id',$sb)->get();
        if(count($mod))
            return true;
        return false;
    }
}
