<?php

namespace App\Http\Controllers\ShowLesson;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShowLesson;
use Storage ; 
use File;


class ShowLessonsController extends Controller
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
        //fetch All Show Lessons Ordered from last to oldest 
        $showLessons = ShowLesson::latest()->get();


        return view('admin.showlesson.index' , compact('showLessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders = $this->getAllOrders() ; 

        return view('admin.showlesson.create',compact('orders'));
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
            
            'title' => 'required|max:200',
            'order' => 'required|integer',
            'src' => 'required|unique:show_lessons'

        ]);


        //Prepare data to save 

        $attributes['title'] = $request->title ; 

        $this->shiftOrdersAfterStore($request->order);
        $attributes['order'] = $request->order ; 

        //Save video URL
        $attributes['src'] = $request->src;


        //Persist data in the database 
        $showLesson = ShowLesson::create($attributes);


        //Return redirect 
        return redirect()
            ->route('showlesson.show', ['showlesson' => $showLesson->id])
            ->with('success', 'تم إنشاء الدرس الاستعراضي بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShowLesson  $showLesson
     * @return \Illuminate\Http\Response
     */
    public function show(ShowLesson $showLesson)
    {
        //Return a view with showlesson Model 
        return view('admin.showlesson.show', compact('showLesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShowLesson  $showLesson
     * @return \Illuminate\Http\Response
     */
    public function edit(ShowLesson $showLesson)
    {
        $orders = $this->getCurrentOrders() ; 
        //go to the edit view for show lesson
        return view('admin.showlesson.edit',compact('showLesson','orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShowLesson  $showLesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShowLesson $showLesson)
    {
        //Vaidate Data 
        $request->validate([
            
            'title' => 'required|max:200',
            'order' => 'required|integer',
            'src' => ''

        ]);


        //Prepare data to save 

        $showLesson->title = $request->title ; 

        //$showLesson->order = $request->order ; 

     
     $showLesson->src = $request->src;
        
        if($request->order != $showLesson->order) {

            //Call the function for updating the order
            $this->shiftOrdersAfterUpdate($showLesson, $showLesson->order, $request->order);
            $showLesson->order = $request->order;
        }
        

        //Persist data in the database 
        $showLesson->save();


        //Return redirect 
        return redirect()
            ->route('showlesson.show', ['showlesson' => $showLesson->id])
            ->with('success', 'تم تعديل الدرس الاستعراضي بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShowLesson  $showLesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShowLesson $showLesson)
    {

        $oldOrder = $showLesson->order ;
        //Delete The showLesson file
        Storage::delete($showLesson->src);

        //Delete ShowLesson from db
        $showLesson->delete();
        //reorder after delete
        $this->shiftOrdersAfterDelete($oldOrder);
        return redirect()->route('showlesson.index')->with('success','تم حذف الدرس الاستعراضي بنجاح');
    }

     //Get new order 
     public function getNewOrder(){


        return ShowLesson::max('order') + 1 ; 
    }


    //Get All Orders 
    public function getAllOrders(){


        $oldOrders = ShowLesson::pluck('order')->toArray(); 


        $lastOrder = ShowLesson::max('order') + 1 ; 

        return array_merge($oldOrders, [$lastOrder]); 
    }


    public function getCurrentOrders(){

        
        return ShowLesson::pluck('order')->toArray() ; 
    }

    public function shiftOrdersAfterStore($order){

        //Fetch All ShowLessons after sepcifed order 
        $showLessons = ShowLesson::where('order','>=',$order)->get();
        foreach($showLessons as $showLesson){

            $oldOrder= $showLesson->order ; 
            $showLesson->order  = $oldOrder + 1 ;  
            $showLesson->save();
        }
    }

    public function shiftOrdersAfterUpdate($oldOrderShowLesson, $oldOrder, $newOrder){

        $oldOrderShowLesson->order = 0;
        $oldOrderShowLesson->save();

        //Fetch All ShowLesson Which It's Order smaller Than Sepcifed order
        if($oldOrder < $newOrder) {
            $showLessons = ShowLesson::whereBetween('order', [$oldOrder, $newOrder+1])->get();
            foreach($showLessons as $showLesson) {
                $showLesson->order -= 1;
                $showLesson->save();
            }
        }

        //Fetch All ShowLesson Which  It's Order Larger Than Sepcifed order
        if($oldOrder > $newOrder) {
            $showLessons = ShowLesson::whereBetween('order', [$newOrder-1, $oldOrder])->get();
            foreach($showLessons as $showLesson) {
                $showLesson->order += 1;
                $showLesson->save();
            }
        }

    }

    public function shiftOrdersAfterDelete($order){

        //Fetch All showLessons after sepcifed order 
        $showLessons = ShowLesson::where('order','>',$order)->get(); 

        


        foreach($showLessons as $showLesson){

            $oldOrder= $showLesson->order ; 

            $showLesson->order  = $oldOrder - 1 ;  
            $showLesson->save();
        }

    }
}

