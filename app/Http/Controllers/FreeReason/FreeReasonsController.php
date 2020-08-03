<?php

namespace App\Http\Controllers\FreeReason;

use App\FreeReason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;


class FreeReasonsController extends Controller
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
        $freeReasons = FreeReason::latest()->get();
        return view('admin.freereasons.index',compact('freeReasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.freereasons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'text' => 'required',
          
        ]);

        $freeReason = new FreeReason();
        $freeReason->text = $request->text;
        $freeReason->save();

        //Return redirect 
        return redirect()
            ->route('freereason.show', ['freeReason' => $freeReason->id])
            ->with('success', 'تم إنشاء سبب الاعفاء بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\FreeReason  $freeReason
     * @return \Illuminate\Http\Response
     */
    public function show(FreeReason  $freeReason)
    {
        $students = Role::find(3)->users()->get();
        
        $freeStudents = FreeReason::find($freeReason->id)->students()->get();
        return view('admin.freereasons.show',compact('freeReason','freeStudents','students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\FreeReason  $freeReason
     * @return \Illuminate\Http\Response
     */
    public function edit(FreeReason  $freeReason)
    {
        return view('admin.freereasons.edit', compact('freeReason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\FreeReason  $freeReason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FreeReason  $freeReason)
    {
        $request->validate([
            'text' => 'required',
            
          ]);
  
          
          $freeReason->text = $request->text;
          $freeReason->save();

          //Return redirect 
        return redirect()
        ->route('freereason.show', ['freeReason' => $freeReason->id])
        ->with('success', 'تم تعديل سبب الاعفاء بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\FreeReason  $freeReason
     * @return \Illuminate\Http\Response
     */
    public function destroy(FreeReason  $freeReason)
    {
        $freeReason->delete();
        return redirect()->back()
        ->with('success','تم حذف سبب الاعفاء بنجاح');
    }


    public function addStudent(Request $request, FreeReason $freeReason)
    {
        $student = User::where('id',$request->student)->get();
        //dd($student);
        $freeReason->students()->syncWithoutDetaching($student);

        //Return redirect 
        return redirect()
            ->route('freereason.show', ['freeReason' => $freeReason->id])
            ->with('success', 'تم اضافة الطالب لسبب الاعفاء بنجاح'); 
    }

    public function deleteStudent( FreeReason $freeReason ,Request $request )
    {
        //$student = User::where('id',$request->student)->get();

        $request->freeReason->students()->detach($request->student_id);

        //Return redirect 
        return redirect()
            ->route('freereason.show', ['freeReason' => $freeReason->id])
            ->with('success', 'تم اضافة الطالب لسبب الاعفاء بنجاح'); 
    }
}
