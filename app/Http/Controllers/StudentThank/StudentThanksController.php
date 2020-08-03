<?php

namespace App\Http\Controllers\StudentThank;
use App\StudentThank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage ; 
use File;

class StudentThanksController extends Controller
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
        //fetch all thanks 
        $studentThanks = StudentThank::latest()->get();

        return view('admin.studentthanks.index', compact('studentThanks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $orders = $this->getAllOrders() ; 

        //go to view create
        return view('admin.studentthanks.create',compact('orders'));
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
            'type' => 'required',
            'src' => '',
            'content' => 'required',
            'order' => 'required|integer'
        ]);

        //Prepare data to save 

        $attributes['type'] = $request->type ; 

        //save File 
        if($request->hasFile('src')){

            $attributes['src'] = $request->src->store('public/studentthanks');
        }

        $attributes['content'] = $request->content ; 

        $this->shiftOrdersAfterStore($request->order);

        $attributes['order'] = $request->order ; 


        //Persist data in the database 
        $studentThank = StudentThank::create($attributes);


        //Return redirect 
        return redirect()
            ->route('studentthank.show', ['studentThank' => $studentThank->id])
            ->with('success', 'تم إنشاءالتشكر بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentThank  $studentThank
     * @return \Illuminate\Http\Response
     */
    public function show(StudentThank $studentThank)
    {
        return view('admin.studentthanks.show', compact('studentThank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentThank  $studentThank
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentThank $studentThank)
    {
        $orders = $this->getCurrentOrders() ; 

        return view('admin.studentthanks.edit',compact('studentThank','orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentThank  $studentThank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentThank $studentThank)
    {
        $request->validate([
            'type' => 'required',
            'src' => '',
            'content' => 'required',
            'order' => 'required|integer'
        ]);

        //Prepare data to save 

        $studentThank->type = $request->type ; 

        if($request->hasFile('src')) {
            Storage::delete($studentThank->src);
            $studentThank->src = $request->src->store('public/studentthanks');
        }
        if($request->order != $studentThank->order) {

            //Call the function for updating the order
            $this->shiftOrdersAfterUpdate($studentThank, $studentThank->order, $request->order);
            $studentThank->order = $request->order;
        }

        $studentThank->content = $request->content ; 

        //$studentThank->order = $request->order ; 


        //update student thank in db 
        $studentThank->save();


        //Return redirect 
        return redirect()
            ->route('studentthank.show', ['studentThank' => $studentThank->id])
            ->with('success', 'تم تعديل التشكر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentThank  $studentThank
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentThank $studentThank)
    {

        $oldOrder = $studentThank->order ; 
        //Delete The student thank file
        Storage::delete($studentThank->src);

        //Delete from db  
        $studentThank->delete();

        $this->shiftOrdersAfterDelete($oldOrder);

        return redirect()
        ->route('studentthank.index')
        ->with('success','تم حذف التشكر بنجاح');
    }

    //Get new order 
    public function getNewOrder(){


        return StudentThank::max('order') + 1 ; 
    }


    //Get All Orders 
    public function getAllOrders(){


        $oldOrders = StudentThank::pluck('order')->toArray(); 


        $lastOrder = StudentThank::max('order') + 1 ; 

        return array_merge($oldOrders, [$lastOrder]); 
    }


    public function getCurrentOrders(){

        
        return StudentThank::pluck('order')->toArray() ; 
    }

    public function shiftOrdersAfterStore($order){

        //Fetch All studentThanks after sepcifed order 
        $studentThanks = StudentThank::where('order','>=',$order)->get();
        foreach($studentThanks as $studentThank){

            $oldOrder= $studentThank->order ; 
            $studentThank->order  = $oldOrder + 1 ;  
            $studentThank->save();
        }
    }

    public function shiftOrdersAfterUpdate($oldOrderstudentThank, $oldOrder, $newOrder){

        $oldOrderstudentThank->order = 0;
        $oldOrderstudentThank->save();

        //Fetch All studentThank Which It's Order smaller Than Sepcifed order
        if($oldOrder < $newOrder) {
            $studentThanks = StudentThank::whereBetween('order', [$oldOrder, $newOrder+1])->get();
            foreach($studentThanks as $studentThank) {
                $studentThank->order -= 1;
                $studentThank->save();
            }
        }

        //Fetch All studentThank Which  It's Order Larger Than Sepcifed order
        if($oldOrder > $newOrder) {
            $studentThanks = StudentThank::whereBetween('order', [$newOrder-1, $oldOrder])->get();
            foreach($studentThanks as $studentThank) {
                $studentThank->order += 1;
                $studentThank->save();
            }
        }

    }

    public function shiftOrdersAfterDelete($order){

        //Fetch All studentThanks after sepcifed order 
        $studentThanks = StudentThank::where('order','>',$order)->get(); 

        


        foreach($studentThanks as $studentThank){

            $oldOrder= $studentThank->order ; 

            $studentThank->order  = $oldOrder - 1 ;  
            $studentThank->save();
        }

    }
}
