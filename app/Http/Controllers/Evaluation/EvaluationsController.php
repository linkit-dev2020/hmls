<?php

namespace App\Http\Controllers\Evaluation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\Evaluation;
use DB;

class EvaluationsController extends Controller
{
    public function __construct()
    {
    
    $this->middleware('auth');
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluations = Evaluation::latest()->get();
        return view('admin.evaluations.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //lesson list 
        $lessons = Lesson::all();
        return view('admin.evaluations.create',compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lesson $lesson)
    {
        //Vaidate Data 
        $request->validate([
            
            'lesson_id' => 'required',
            'value' => 'required|integer',
            'student_id' => 'required'

        ]);

        //Prepare object to save
        $attributes = [];
        $attributes['value'] = $request->value;
        $attributes['lesson_id'] = $request->lesson_id;
        $attributes['student_id'] = $request->student_id;

        //Prepare to begin a transaction
        DB::transaction(function ( ) use ($attributes) {
            Evaluation::create($attributes);
        });

        //Return redirect 
        return redirect()
            ->back()
            ->with('success', 'تم تقييم الدرس بنجاح');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation  $evaluation)
    {
        return view('admin.evaluations.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation  $evaluation)
    {
        return view('admin.evaluations.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation  $evaluation)
    {
        //Vaidate Data 
        $request->validate([
            
            
            'value' => 'required|integer'
            

        ]);

        //prepare object to save
        
        $evaluation->value= $request->value;
       
        $evaluation->save();

        //Return redirect 
        return redirect()
        ->back()
        ->with('success', 'تم تقييم الدرس بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation  $evaluation)
    {
        //Delete evaluation from db
        $evaluation->delete();
        

        return redirect()->back()
        ->with('success','تم حذف التقييم بنجاح');
    }
}
