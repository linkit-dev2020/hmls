<?php

namespace App\Http\Controllers\Advice;

use App\Advice;
use App\ClassRoom;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage ; 
use File;
use Validator ; 

class AdvicesController extends Controller
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
        $advices = Advice::latest()->get();
        return View('admin.advices.index',compact('advices'));
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

        return view('admin.advices.create', compact('classes', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
/*
        $v->sometimes('reason', 'required|max:500', function ($input) {
            return $input->games >= 100;
        });*/
        //Vaidate Data 

        //'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime'

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:200',
            'type' => 'required',
            'active' => 'required',
            'src' => ''
        ]);

      

        if ($validator->fails()) {
            return redirect()
                        ->route('advice.create')
                        ->withErrors($validator)
                        ->withInput();
        }

  /*     
        /*$request->validate([
            
            'title' => 'required|max:200',
            'type' => 'required',
            'active' => 'required',
            'src' => 'required'

        ]);*/

       


        //Prepare data to save 

       /* $attributes['title'] = $request->title ; 
        $attributes['type'] = $request->type ;
        $attributes['active'] = $request->active ? true : false ;
        $attributes['src'] =$request->src;
        //save File 
       
       
         if ($request->hasFile('src'))
          {
                $attributes['src'] = $request->file('src')->getClientOriginalExtension();
              dd($extention,$request->type);
          } 

         //Persist data in the database 
         $advice = Advice::create($attributes);

         

         //Return redirect 
   */
        
        $advice =new advice();
        $advice['title'] = $request->title ; 
        $advice['type'] = $request->type ;
        $advice['active'] = $request->active ? true : false ;
        
          if ($request->hasFile('src'))
        {
            $extention = $request->file('src')->getClientOriginalExtension();
            //dd($extention,$request->type);

            if($request->type ==='audio' && $extention === 'mp3')
            {
                $advice->src = $request->src->storeAs('public/advices', time().$request->src->getClientOriginalName());
            }
            else
            {return redirect()->back()->withError('يرجى اختيار الملف من النوع المحدد');}
        }
         
         
         
          if($request->type ==='video' )
            {
                $advice->src = $request->src ;
            }

        try {
   $advice->save();
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                 
                   return redirect()
            ->back()
            ->withError('الرجاء  الانتباه الى وجود بيانات  مكررة ,  قد يكون رابط الفيديو او الرابط موجود مسبقاَ');
            }
        }
        
        
        if($request->class_id != "-- اختر الصف   --"&& $request->class_id != null){
            //$arr= $lesson->fresh()->unit->pluck('pivot.lesson_order')->toArray();
            //$lesson->fresh()->units[1]->pivot->lesson_order = 1 ;
            $advice->classes()->syncWithoutDetaching($request->class_id );
         }
         
         
         if($request->course_id != "-- اختر الدورة --" && $request->course_id != null){
            $advice->courses()->syncWithoutDetaching($request->course_id);
        }
        
          return redirect()
        ->route('advice.show', ['advice' => $advice->id])
        ->with('success', 'تم إنشاء النصيحة بنجاح');
    }

    /**if (strpos($a, 'are') !== false) {
    echo 'true';
}
     * Display the specified resource.
     *
     * @param  App\Advice $advice
     * @return \Illuminate\Http\Response
     */
    public function show(Advice $advice)
    {
         $src = '' ;
         if(strpos($advice->src, 'youtu.be')){
             $src=str_replace("/storage//youtu.be/","",$advice->src);
         }
                  
         $adviceClasses = $advice->classes ;
         $adviceCourses = $advice->courses ;

        return view('admin.advices.show',compact('advice','src' , 'adviceClasses' , 'adviceCourses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Advice $advice
     * @return \Illuminate\Http\Response
     */
    public function edit(Advice $advice)
    {
        $classes = ClassRoom::all();
        $courses = Course::all();
        return view('admin.advices.edit',compact('advice','classes','courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Advice $advice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advice $advice)
    {
        $request->validate([
            
            'title' => 'required|max:200',
            'type' => 'required',
            'active' => 'required',
            'src' => ''

        ]);

        $advice->title = $request->title ;
        $advice->type = $request->type ;  
        $advice->active = $request->active ? true : false ;  

        
    if ($request->hasFile('src'))
        {        $extention = $request->file('src')->getClientOriginalExtension();
        
            //dd($extention,$request->type);

            if($request->type ==='audio' && $extention === 'mp3')
            {
                   Storage::delete($advice->src);
                   $advice->src = $request->src->store('public/advices');
            
            }
            else
            {return redirect()->back()->withError('يرجى اختيار الملف من النوع المحدد');}
        }
        
         
          if($request->type ==='video' )
            {
                $advice->src = $request->embadedCode_src ; 
            }
        
                 try {
   $advice->save();
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                 
                   return redirect()
            ->back()
            ->withError('الرجاء  الانتباه الى وجود بيانات  مكررة ,  قد يكون رابط الفيديو او الرابط موجود مسبقاَ');
            }
        }

        

        //Return redirect 
        return redirect()
            ->route('advice.show', ['advice' => $advice->id])
            ->with('success', 'تم تعديل النصيحة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Advice $advice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advice $advice)
    {


         //Delete The advice file
         Storage::delete($advice->src);
        // $advice->classes()->delete();
         //Delete advice from db
         $advice->delete();

       return redirect()->route('advice.index')
        ->with('success','تم حذف النصيحة بنجاح');
    }

    public function activate(Advice $advice){

        $advice->makeActive();
        
        $advice->save();
        
        return redirect()->route('advice.index', ['advice' => $advice->id])
                ->with('success','تم تفعيل النصيحة بنجاح');
    }

     /**
      * Action to deactivate A advice
      */
      public function deactivate(Advice $advice){
        $advice->makeInactive();
        $advice->save();

        return redirect()->route('advice.index', ['advice' => $advice->id])
                ->with('success', 'تم إلغاء تفعيل النصيحة بنجاح');

      }
}
