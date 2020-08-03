<?php

namespace App\Http\Controllers;

use App\ClassRoom;
use App\Subject;
use App\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    //
    public function getSubjects($id)
    {
        $resp="";

        if(ClassRoom::find($id)==null) return "";
        foreach (ClassRoom::find($id)->subjects as $sub)
        {
            $line='<option id="sub'.$sub->id.'" value="'.$sub->id.'">'.$sub->name.'</option>';
            $resp.=$line;
        }
        return $resp;
    }

    public function getSubjectsOfUser($cid,$uid)
    {
        $resp="";

        if(ClassRoom::find($cid)==null) return "";
        foreach (User::find($uid)->subjects->where('class_id',$cid) as $sub)
        {
            $line='<option id="sub'.$sub->id.'" value="'.$sub->id.'">'.$sub->name.'</option>';
            $resp.=$line;
        }
        return $resp;
    }

    public function getUnits($id)
    {
        $resp="";
        if(Subject::find($id)==null) return "";
        foreach (Subject::find($id)->units as $sub)
        {
            $line='<option value="'.$sub->id.'">'.$sub->title.'</option>';
            $resp.=$line;
        }
        return $resp;
    }
}
