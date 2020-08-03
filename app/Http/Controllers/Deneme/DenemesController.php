<?php

namespace App\Http\Controllers\Deneme;

use App\ClassRoom;
use App\Deneme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage ; 
use File;

class DenemesController extends Controller
{
    public function __construct()
    {
    
    $this->middleware('auth');
    
    }

    protected $types = ['فيديو', 'صورة', 'PDF ملف', 'Word ملف', 'رابط'];
    protected $terms = ['الفصل الأول', 'الفصل الثاني'];
    protected $active = ['فعال', 'غير فعال'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $denemes = Deneme::latest()->get();
        $types = $this->types;
        $terms = $this->terms;
        return view('admin.denemes.index', compact('denemes', 'types', 'terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassRoom::all();
        $types = $this->types;
        $terms = $this->terms;

        return view('admin.denemes.create',compact('classes', 'types', 'terms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //validate data
        $request->validate([
          'title' => 'required|max:200',
          'term' => 'required|integer',
          'active' =>'required',
          'type' => 'required',
          'src' => ''
        ]);

        //Prepare data to save 

        $attributes['title'] = $request->title ; 

        $attributes['active'] =  $request->active ? true : false ; 

        $attributes['term'] = $request->term ;

        $attributes['type'] = $request->type ;


        if($request->hasFile('src')){

            $attributes['src'] = $request->src->store('public/denemes');

        }
        elseif($request->url_src != null) {
            $attributes['src'] = $request->url_src;
        }
        elseif($request->embadedCode_src != null) {
            $attributes['src'] = $request->embadedCode_src;
        }
        

        $attributes['class_id'] = $request->class_id ;


        //Persist data in the database 
        $deneme = Deneme::create($attributes);


        //Return redirect 
        return redirect()
            ->route('deneme.show', ['deneme' => $deneme->id])
            ->with('success', 'تم إنشاءالدينمي بنجاح');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deneme  $deneme
     * @return \Illuminate\Http\Response
     */
    public function show(Deneme $deneme)
    {
        $types = $this->types;
        $terms = $this->terms;
        $active = $this->active;

        return view('admin.denemes.show', compact('deneme', 'active', 'terms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deneme  $deneme
     * @return \Illuminate\Http\Response
     */
    public function edit(Deneme $deneme)
    {
        $classes = ClassRoom::all();
        $terms = $this->terms;
        $types = $this->types;
        return view('admin.denemes.edit', compact('deneme', 'classes', 'terms', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deneme  $deneme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deneme $deneme)
    {

        //validate data
        $request->validate([
            'title' => 'required|max:200',
            'term' => 'required|integer',
            'active' => 'required',
            'type' => 'required',
            'class_id' => 'required',
          
          ]);

        //Prepare data to save 

        $deneme->title = $request->title ; 

        $deneme->term = $request->term ; 

        $deneme->active = $request->active ? true : false ; 

        $deneme->type = $request->type ; 

            //handle upload file to lesson or set URL
          if ($request->src === null && $request->url_src === null && $request->embadedCode_src === null)
        {
          return redirect()->back()->withError('اختر رابط او ملف');
        }

     
        
            if ($request->hasFile('src'))
          {
              $extention = $request->file('src')->getClientOriginalExtension();
              //dd($extention,$request->type);
              
               if($extention === 'jpg'&&$request->type ==='image'|| $extention === 'png' && $request->type ==='image') 
               {
                 $deneme->src = $request->src->storeAs('public/denemes', time().$request->src->getClientOriginalName());
               }
               elseif($extention === 'pdf' && $request->type ==='pdf') 
               {
                 $deneme->src = $request->src->storeAs('public/denemes', time().$request->src->getClientOriginalName());
               } 
               elseif($extention === 'docx' && $request->type ==='word')
               {
                 $deneme->src = $request->src->storeAs('public/denemes', time().$request->src->getClientOriginalName());
               } 
               else
               {return redirect()->back()->withError('يرجى اختيار الملف من النوع المحدد');}
          }
       
          elseif($request->url_src != null) {
            $deneme->src = $request->url_src;
            
          }elseif($request->embadedCode_src !=null) {
            $deneme->setSrcAttribute($request->embadedCode_src);
          }
        

        //update deneme in db 
        $deneme->save();


        //Return redirect 
        return redirect()
            ->route('deneme.show', ['deneme' => $deneme->id])
            ->with('success', 'تم تعديل التشكر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deneme  $deneme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deneme $deneme)
    {
        //Delete The deneme file
        Storage::delete($deneme->src);

        //Delete deneme from db
        $deneme->delete();
        return redirect()->route('deneme.index')
        ->with('success','تم حذف الدينيمي بنجاح');
    }

    /**
     * Action to Activate A Course 
     */
    public function activate(Deneme $deneme){

        $deneme->active = true;
        
        $deneme->save();
        
        return redirect()->route('deneme.show', ['deneme' => $deneme->id])
                ->with('success','تم تفعيل الدينيمي بنجاح');
    }

     /**
      * Action to deactivate A Deneme
      */
      public function deactivate(Deneme $deneme){
        $deneme->active = false;
        $deneme->save();

        return redirect()->route('deneme.show', ['deneme' => $deneme->id])
                ->with('success', 'تم إلغاء تفعيل الدينيمي بنجاح');

      }
}
