<?php

namespace App\Http\Controllers\Reply;

use App\Reply;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepliesController extends Controller
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
        $replies = Reply::latest()->get();
        return View('admin.replies.index',compact('replies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comments = Comment::all();
        return view('admin.replies.create',compact('comments'));
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
            'replyer_type' => 'required|integer',
            'comment_id' => 'required|integer',
            'replyer_id' => 'required',

        ]);


        //Prepare data to save 

        $attributes['content'] = $request->content ; 

        
        $attributes['replyer_type'] = $request->replyer_type ; 


        $attributes['replyer_id'] = $request->replyer_id ; 
     

        $attributes['comment_id'] = $request->comment_id ; 

        //Persist data in the database 
        $reply = Reply::create($attributes);


        //Return redirect 
        return redirect()
            ->route('reply.show', ['reply' => $reply->id])
            ->with('success', 'تم الرد بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        return view('admin.replies.show',compact('reply'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        $comments = Comment::all();
        return view('admin.replies.edit',compact('reply','comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
          //Vaidate Data 
          $request->validate([
            
            'content' => 'required|max:200',
            'replyer_type' => 'required|integer',
            'comment_id' => 'required|integer',
            'replyer_id' => 'required',

        ]);

        $reply->content =$request->content;
        $reply->replyer_type =$request->replyer_type;
        $reply->comment_id =$request->comment_id;
        $reply->replyer_id =$request->replyer_id;

        $reply->save();

         //Return redirect 
         return redirect()
         ->route('reply.show', ['reply' => $reply->id])
         ->with('success', 'تم تعديل الرد بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();
        return redirect()->back()
         ->with('success','تم حذف الرد بنجاح');
    }
}
