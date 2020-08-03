<?php

namespace App\Http\Controllers\Note;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClassRoom;
use App\Note;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();
        return view('admin.notes.index',compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassRoom::all();
        return view('admin.notes.create',compact('classes'));
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
            'content' => 'required',
            'type' => 'required',
            'class_id' => 'required'
        ]);

         $note = new Note();
         $note->content = $request->content;
         $note->type = $request->type;
         $note->class_id = $request->class_id;

         $note->save();

         return redirect()->route('notes.index')->with('success','تم انشاء الملاحظة بنجاح');


    }

    /**
     * Display the specified resource.
     *
     * @param  App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return view('admin.notes.show',compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        $classes = ClassRoom::all();
        return view('admin.notes.edit',compact('note','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'content' => 'required',
            'type' => 'required',
            'class_id' => 'required'
        ]);

         $note->content = $request->content;
         $note->type = $request->type;
         $note->class_id = $request->class_id;

         $note->save();

         return redirect()->route('notes.index')->with('success','تم تعديل الملاحظة بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()
        ->back()
        ->with('success','تم حذف الملاحظة بنجاح');
    }
}
