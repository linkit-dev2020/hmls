<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RequestClass;
use Auth;
use App\ClassRoom;

class ClassRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = RequestClass::all()->where('status' , -1);
        return view('admin.requestclass.index',compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exist = RequestClass::where('class_id',$request->class_id)
        ->where('student_id', Auth::user()->id)->first();


        if($exist != null)
        {
          return redirect()->back()->withError('لقد ارسلت طلب انضمام بالفعل');
        }
        $requestClass = new RequestClass();
        $requestClass->student_id = Auth::user()->id;
        $requestClass->class_id = $request->class_id;
        $requestClass->save();
        return redirect()->back()->with('success','تم ارسال الطلب بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\RequestClass  $requestClass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
 
        
        $requestClass= RequestClass::where('id',$id)->first();
        //dd($requestClass);
        $class = ClassRoom::where('id',$requestClass->class_id)->first();
        //dd($requestClass->student_id);
        $class->students()->syncWithoutDetaching($requestClass->student_id);
        
       //Delete lesson from db
       $requestClass->delete();

       return redirect()->back()
      ->with('success','تم قبول الطلب بنجاح');   
    }


    public  function  accept($id){
        $requestClass= RequestClass::where('id',$id)->first();
        $requestClass->status = 1  ;
        $class = ClassRoom::where('id',$requestClass->class_id)->first();
        $class->students()->syncWithoutDetaching($requestClass->student_id);
        $requestClass->save();
        return redirect()->back()
            ->with('success','تم قبول الطلب بنجاح');
    }

    public  function  remove($id){
        $requestClass= RequestClass::find($id);
        $requestClass->delete();
        return redirect()->back()
            ->with('success','تم حذف الطلب بنجاح');
    }
}
