<?php

namespace App\Http\Controllers\Comment;

use App\Comment;
use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
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
        $comments = Comment::latest()->get();
        return View('admin.comments.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessons = Lesson::all();
        return view('admin.comments.create',compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //Vaidate Data 
         $request->validate([
            
            'content' => 'required|max:200',
            'commenter_type' => 'required|integer',
            'lesson_id' => 'required|integer',
            'commenter_id' => 'required',

        ]);


        //Prepare data to save 

        $attributes['content'] = $request->content ; 

        
        $attributes['commenter_type'] = $request->commenter_type ; 


        $attributes['commenter_id'] = $request->commenter_id ; 
     

        $attributes['lesson_id'] = $request->lesson_id ; 

        //Persist data in the database 
        $comment = Comment::create($attributes);


        //Return redirect 
        return redirect()
            ->route('comment.show', ['comment' => $comment->id])
            ->with('success', 'تم التعليق بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('admin.commnets.show',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $lessons = Lesson::all();
        return view('admin.comments.edit',compact('comment','lessons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        
        //Vaidate Data 
        $request->validate([
            
            'content' => 'required|max:200',
            'commenter_type' => 'required|integer',
            'lesson_id' => 'required|integer',
            'commenter_id' => 'required',

        ]);

        $comment->content =$request->content;
        $comment->commenter_type =$request->commenter_type;
        $comment->lesson_id =$request->lesson_id;
        $comment->commenter_id =$request->commenter_id;

        $comment->save();

         //Return redirect 
         return redirect()
         ->route('comment.show', ['comment' => $comment->id])
         ->with('success', 'تم تعديل التعليق بنجاح');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()
         ->with('success','تم حذف التعليق بنجاح');
    }
}
