<?php



namespace App\Http\Controllers\Attachment;



use App\Attachment;

use App\Lesson;

use App\Deneme;

use App\Test;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Storage ; 

use File;



class AttachmentsController extends Controller

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

        $attachments = Attachment::latest()->get();

        return view('admin.attachments.index',compact('attachments'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $lessons = Lesson::latest()->get();

        $denemes = Deneme::latest()->get();

        $tests = Test::latest()->get();



        return view('admin.attachments.create', compact('lessons', 'denemes', 'tests'));

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

            

            'name' => 'required|max:200',

            'type' => 'required',

            'attachmentable_id' => 'required',

            'attachmentable_type' => 'required'



        ]);





        //Prepare data to save 



        $attributes['name'] = $request->name ; 



        

        $attributes['type'] = $request->type ;



        $attributes['attachmentable_type'] = $request->attachmentable_type ;

        $attributes['attachmentable_id'] = $request->attachmentable_id ;



        //save File 

        if($request->hasFile('src')){
            $attributes['src'] = $request->src->store('public/attachments');
        }
        else
        {
            $attributes['src']=$request->embadedCode_src;
        }




        //Persist data in the database 

        $attachment = Attachment::create($attributes);



        //Attach with Object

        if($request->attachmentable_type === 'App\Lesson') {

            $lesson = Lesson::where('id', $request->attachmentable_id)->get();

            $attachment->attachmentable()->syncWithoutDetaching($lesson);

            

        }elseif($request->attachmentable_type === 'App\Deneme') {

            $deneme = Deneme::where('id', $request->attachmentable_id)->get();

            $attachment->attachmentable()->syncWithoutDetaching($deneme);

        }elseif($request->attachmentable_type === 'App\Test') {

            $Test = Test::where('id', $request->attachmentable_id)->get();

            $attachment->attachmentable()->syncWithoutDetaching($Test);

        }


        //Return redirect 

        return redirect()

            ->route('attachment.index', ['attachment' => $attachment->id])

            ->with('success', 'تم إنشاء الملحق بنجاح');

    }



    /**

     * Display the specified resource.

     *

     * @param  App\Attachment $attachment

     * @return \Illuminate\Http\Response

     */

    public function show(Attachment $attachment)
    {
        return view('admin.attachments.show',compact('attachment'));
    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  App\Attachment $attachment

     * @return \Illuminate\Http\Response

     */

    public function edit(Attachment $attachment)

    {
        $lessons = Lesson::latest()->get();

        $denemes = Deneme::latest()->get();

        $tests = Test::latest()->get();

        return view('admin.attachments.edit',compact('attachment', 'lessons', 'denemes', 'tests'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  App\Attachment $attachment

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Attachment $attachment)

    {

        //Vaidate Data 

        $request->validate([

            

            'name' => 'required|max:200',

            'type' => 'required',

            'src' => '',

            'attachmentable_id' => 'required',

            'attachmentable_type' => 'required'



        ]);



        $attachment->name = $request->name;

        $attachment->type = $request->type;

        $attachment->attachmentable_type = $request->attachmentable_type;

        $attachment->attachmentable_id = $request->attachmentable_id;

        if($request->hasFile('src')) {

            Storage::delete($attachment->src);

            $attachment->src = $request->src->store('public/attachments');

        }



        $attachment->save();



        //Return redirect 

        return redirect()

            ->route('attachment.index', ['attachment' => $attachment->id])

            ->with('success', 'تم تعديل الملحق بنجاح');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  App\Attachment $attachment

     * @return \Illuminate\Http\Response

     */

    public function destroy(Attachment $attachment)

    {

        //Delete The attachment file

        Storage::delete($attachment->src);



        //Delete attachment from db

        $attachment->delete();



        return redirect()->back()

        ->with('success','تم حذف الملحق بنجاح');

    }

}

