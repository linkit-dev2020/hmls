<?php

namespace App\Http\Controllers\WhatsappLink;

use App\WhatsappLink;
use App\ClassRoom;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage ; 
use File;

class WhatsappLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whatsappLinks = WhatsappLink::latest()->get();
        return view('admin.whatsapplinks.index' , compact('whatsappLinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassRoom::latest()->get();
        $courses = Course::latest()->get();
        $orders = $this->getAllOrders() ; 

        return view('admin.whatsapplinks.create',compact('classes' ,'courses' , 'orders'));
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
            
            'url' => 'required',
            'order' => 'required|integer',
            'type' => 'required',
            'linkable_id' => 'required',
            'linkable_type' => 'required'

        ]);


        //Prepare data to save 

        $attributes['url'] = $request->url ; 

        $this->shiftOrdersAfterStore($request->order);
        $attributes['order'] = $request->order ;
        $attributes['linkable_id'] = $request->linkable_id ;
        $attributes['linkable_type'] = $request->linkable_type ; 
        $attributes['type'] = $request->type;
          try {
   //Persist data in the database 
        $whatsappLink = WhatsappLink::create($attributes);
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                 
                   return redirect()
            ->back()
            ->withError('الرجاء الانتباه الى وجود بيانات  مكررة,  قد يكون الرابط مكرر !');
            }
        }

     


        //Return redirect 
        return redirect()
            ->route('whatsapplink.index', ['whatsappLink' => $whatsappLink->id])
            ->with('success', 'تم إنشاء رابط واتساب بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\WhatsappLink $whatsappLink
     * @return \Illuminate\Http\Response
     */
    public function show(WhatsappLink $whatsappLink)
    {
        //Return a view with whatsapplink Model 
        return view('admin.whatsapplinks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\WhatsappLink $whatsappLink
     * @return \Illuminate\Http\Response
     */
    public function edit(WhatsappLink $whatsappLink)
    {
        $classes = ClassRoom::latest()->get();
        $courses = Course::latest()->get();
        $orders = $this->getAllOrders() ;

        return view('admin.whatsapplinks.edit',compact('whatsappLink' ,'classes' ,'courses' , 'orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\WhatsappLink $whatsappLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhatsappLink $whatsappLink)
    {
        $request->validate([
            
            'url' => 'required',
            'order' => 'required|integer',
            'src' => '',
            'type' => 'required',
            'linkable_id' => 'required',
            'linkable_type' => 'required'

        ]);

        $whatsappLink->url = $request->url ;
        $whatsappLink->linkable_id = $request->linkable_id;
        $whatsappLink->linkable_type = $request->linkable_type;
        $whatsappLink->type = $request->type;
        
        if($request->hasFile('src')) {
            Storage::delete($whatsappLink->src);
            $whatsappLink->src = $request->src->store('public/whatsapplinks');
        }

        if($request->order != $whatsappLink->order) {

            //Call the function for updating the order
            $this->shiftOrdersAfterUpdate($whatsappLink, $whatsappLink->order, $request->order);
            $whatsappLink->order = $request->order;
        }

        $whatsappLink->save();

         //Return redirect 
         return redirect()
         ->route('whatsapplink.index', ['whatsappLink' => $whatsappLink->id])
         ->with('success', 'تم تعديل رابط واتساب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\WhatsappLink $whatsappLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhatsappLink $whatsappLink)
    {
        $oldOrder = $whatsappLink->order ;
        //Delete The whatsappLink file
        Storage::delete($whatsappLink->src);

        //Delete whatsappLink from db
        $whatsappLink->delete();
        //reorder after delete
        $this->shiftOrdersAfterDelete($oldOrder);

        return redirect()->back()
        ->with('success','تم حذف رابط واتساب بنجاح');
    }

    //Get new order 
    public function getNewOrder(){


        return WhatsappLink::max('order') + 1 ; 
    }


    //Get All Orders 
    public function getAllOrders(){


        $oldOrders = WhatsappLink::pluck('order')->toArray(); 


        $lastOrder = WhatsappLink::max('order') + 1 ; 

        return array_merge($oldOrders, [$lastOrder]); 
    }


    public function getCurrentOrders(){

        
        return WhatsappLink::pluck('order')->toArray() ; 
    }

    public function shiftOrdersAfterStore($order){

        //Fetch All WhatsappLinks after sepcifed order 
        $whatsappLinks = WhatsappLink::where('order','>=',$order)->get();
        foreach($whatsappLinks as $whatsappLink){

            $oldOrder= $whatsappLink->order ; 
            $whatsappLink->order  = $oldOrder + 1 ;  
            $whatsappLink->save();
        }
    }

    public function shiftOrdersAfterUpdate($oldOrderWhatsappLink, $oldOrder, $newOrder){

        $oldOrderWhatsappLink->order = 0;
        $oldOrderWhatsappLink->save();

        //Fetch All whatsappLink Which It's Order smaller Than Sepcifed order
        if($oldOrder < $newOrder) {
            $whatsappLinks = WhatsappLink::whereBetween('order', [$oldOrder, $newOrder+1])->get();
            foreach($whatsappLinks as $whatsappLink) {
                $whatsappLink->order -= 1;
                $whatsappLink->save();
            }
        }

        //Fetch All whatsappLink Which  It's Order Larger Than Sepcifed order
        if($oldOrder > $newOrder) {
            $whatsappLinks = WhatsappLink::whereBetween('order', [$newOrder-1, $oldOrder])->get();
            foreach($whatsappLinks as $whatsappLink) {
                $whatsappLink->order += 1;
                $whatsappLink->save();
            }
        }

    }

    public function shiftOrdersAfterDelete($order){

        //Fetch All whatsappLinks after sepcifed order 
        $whatsappLinks = WhatsappLink::where('order','>',$order)->get(); 

        


        foreach($whatsappLinks as $whatsappLink){

            $oldOrder= $whatsappLink->order ; 

            $whatsappLink->order  = $oldOrder - 1 ;  
            $whatsappLink->save();
        }

    }


    public function getData($type) 
    {       
        if($type === 'class') {
                $data = DB::table("classes")->pluck("id","name");
                return json_encode($data);
            }
            if($type === 'course') {
                $data = DB::table("courses")->pluck("id","title");
                return json_encode($data);
            }
    }

}
