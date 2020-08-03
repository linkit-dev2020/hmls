<?php

namespace App\Http\Controllers\Carousel;

use App\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage ; 
use File;

class CarouselsController extends Controller
{
    public function __construct()
    {
    
    $this->middleware('auth');
    
    }
    /**
     * Display a listing of the Carouels.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        



        $carousels = Carousel::latest()->get(); 

        return view('admin.carousels.index', compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders = $this->getAllOrders() ; 

        return view('admin.carousels.create',compact('orders')); 
        
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
            'src' => 'required',
            'order' => 'required|integer'
        ]);
            
        
        $attributes = [];
        //save Image 
            if($request->hasFile('src')){

                    //$attributes['src'] = $request->src->store('public/carousels');
                    $attributes['src'] = $request->src->storeAs('public/carousels', $request->src->getClientOriginalName());

            }


        //Save Order 


     

         $this->shiftOrdersAfterStore($request->order);

      

        $attributes['order'] = $request->order ; 

       

        Carousel::create($attributes);
        
        return redirect()
                ->route('carousel.index')
                ->with('success','تم إنشاء عنصر قلاب جديد');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function show(Carousel $carousel)
    {
        
        return view('admin.carousels.show', compact('carousel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit(Carousel $carousel)
    {
        
        $orders = $this->getCurrentOrders() ; 


        return view('admin.carousels.edit' , compact('carousel','orders')); 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carousel $carousel)
    {
        //Fields Validation
        $request->validate([
            'src' => '',
            'order' => 'required|integer'
        ]);

        //Delete old img and save new one
        if($request->hasFile('src')) {
            Storage::delete($carousel->src);
            $carousel->src = $request->src->storeAs('public/carousels', $request->src->getClientOriginalName());
        }
        if($request->order != $carousel->order) {

            //Call the function for updating the order
            $this->shiftOrdersAfterUpdate($carousel, $carousel->order, $request->order);
            $carousel->order = $request->order;
            
        }
        $carousel->save();

        return  redirect()
                ->route('carousel.show', $carousel)
                ->with('Success', 'تم تعديل الصورة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carousel $carousel)
    {
        
        $oldOrder = $carousel->order ; 

        //Delete The carousel image
        Storage::delete($carousel->src);

        //Delete The table 
        $carousel->delete();

        $this->shiftOrdersAfterDelete($oldOrder);


        return redirect()
                ->route('carousel.index')
                ->with('success','تم حذف عنصر القلاب بنجاح');



        
    }

    //Get new order 
    public function getNewOrder(){


        return Carousel::max('order') + 1 ; 
    }


    //Get All Orders 
    public function getAllOrders(){


        $oldOrders = Carousel::pluck('order')->toArray(); 


        $lastOrder = Carousel::max('order') + 1 ; 

        return array_merge($oldOrders, [$lastOrder]); 
    }


    public function getCurrentOrders(){

        
        return Carousel::pluck('order')->toArray() ; 
    }

    public function shiftOrdersAfterStore($order){

        //Fetch All carousels after sepcifed order 
        $carousels = Carousel::where('order','>=',$order)->get();
        foreach($carousels as $carousel){

            $oldOrder= $carousel->order ; 
            $carousel->order  = $oldOrder + 1 ;  
            $carousel->save();
        }
    }

    public function shiftOrdersAfterUpdate($oldOrderCarousel, $oldOrder, $newOrder){

        $oldOrderCarousel->order = 0;
        $oldOrderCarousel->save();

        //Fetch All Carousel Which It's Order smaller Than Sepcifed order
        if($oldOrder < $newOrder) {
            $carousels = Carousel::whereBetween('order', [$oldOrder, $newOrder+1])->get();
            foreach($carousels as $carousel) {
                $carousel->order = $carousel->order-1;
                $carousel->save();
            }
        }

        //Fetch All Carousel Which  It's Order Larger Than Sepcifed order
        if($oldOrder > $newOrder) {
            $carousels = Carousel::whereBetween('order', [$newOrder-1, $oldOrder])->get();
            foreach($carousels as $carousel) {
                $carousel->order = $carousel->order+1;
                $carousel->save();
            }
        }

    }

    public function shiftOrdersAfterDelete($order){

        //Fetch All carousels after sepcifed order 
        $carousels = Carousel::where('order','>',$order)->get(); 

        


        foreach($carousels as $carousel){

            $oldOrder= $carousel->order ; 

            $carousel->order  = $oldOrder - 1 ;  
            $carousel->save();
        }

    }
}
