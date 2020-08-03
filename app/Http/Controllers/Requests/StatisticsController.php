<?php
/**
 * Created by PhpStorm.
 * User: Inspiron
 * Date: 7/20/2019
 * Time: 4:43 PM
 */

namespace App\Http\Controllers\Requests;


use App\RequestClass;
use App\RequestCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\ClassRoom;
class StatisticsController extends Controller
{

      public  function getAllRequests(){

//
            $requestsClasses = RequestClass::where('status' , 1)->get();
            $requestsCourses = RequestCourse::where('status' , 1)->get();


          return view('admin.requests.getAllRequests',compact('requestsClasses','requestsCourses' ));
      }
}