<?php



namespace App\Http\Controllers\Test;



use App\Notifications\NotficationManager;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Test;

use App\Attachment;

use App\Subject;

use Illuminate\Support\Facades\Auth;
use Storage ;

use File;



class TestController extends Controller

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

        //$tests = Test::with('subjects')->get();

        $tests=[];
        if (Auth::user()->hasAnyRole([0,1]))
        {
            $tests = Test::with('subjects')->get();
        }

        else{
            $subs= Auth::user()->subjects;

            foreach ($subs as $sub)
            {
                foreach ($sub->tests as $test)
                {
                    array_push($tests,$test);
                }
            }
        }
        return view('admin.tests.index',compact('tests'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $attachments = Attachment::latest()->get();

        if (Auth::user()->hasAnyRole([0,1]))
        {
            $subjects=Subject::latest()->get();
        }
        else{
            $subjects = Auth::user()->subjects;
        }


        return view('admin.tests.create', compact('attachments','subjects'));

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

            'term' => 'required|integer',

            'sub_test' => 'required|integer',

            'active' => 'required',

            'type' => 'required',

            'src' => ''



        ]);





        //Prepare data to save



        $attributes['title'] = $request->title ;





        $attributes['term'] = $request->term ;
        $attributes['type'] = $request->type ;


        //save File

//        if($request->hasFile('src')){

//

//            $attributes['src'] = $request->src->store('public/tests');

//

//        }



        if ($request->hasFile('src'))

        {

            $extention = $request->file('src')->getClientOriginalExtension();

            //dd($extention,$request->type);



            if($extention === 'jpg'&&$request->type ==='image'|| $extention === 'png' && $request->type ==='image')

            {

                $attributes['src']= $request->src->storeAs('public/tests', time().$request->src->getClientOriginalName());

            }

            elseif($extention === 'pdf' && $request->type ==='pdf')

            {

                $attributes['src'] = $request->src->storeAs('public/tests', time().$request->src->getClientOriginalName());

            }

            elseif($extention === 'docx' && $request->type ==='word')

            {

                $attributes['src'] = $request->src->storeAs('public/tests', time().$request->src->getClientOriginalName());

            }

            else

            {return redirect()->back()->withError('يرجى اختيار الملف من النوع المحدد');}

        }


        if($request->type ==='video' )

        {

            $attributes['src']  = $request->embadedCode_src ;

        }

        $attributes['active'] = $request->active ? true : false ;



        $attributes['sub_test'] = $request->sub_test ;





        //Persist data in the database

        $test = Test::create($attributes);



        $test->subjects()->syncWithoutDetaching($request->subject_id);

        //Attach with attachment

        // if($request->attachments != null){

        //     $attachments = $request->attachments;

        //     foreach($attachments as $attachment) {

        //         $attachment->courses()->syncWithoutDetaching($request->course_id);

        //     }

        // }

        $sub=Subject::find($request->subject_id);
        NotficationManager::notifyNewTest($sub,Auth::user());
        //Return redirect

        return redirect()

            ->route('test.show', ['test' => $test->id])

            ->with('success', 'تم إنشاء الاختبار بنجاح');

    }



    /**

     * Display the specified resource.

     *

     * @param  App\Test $test

     * @return \Illuminate\Http\Response

     */

    public function show(Test $test)

    {

        $allAttachments = Attachment::latest()->get();

        $attachments = $test->attachments()->get();
        $subjects = $test->subjects ;

        $src = '' ;

        if(strpos($test->src, 'youtu.be')){

            $src=str_replace("/storage//youtu.be/","",$test->src);

        }

        return view('admin.tests.show',compact('test', 'attachments','allAttachments' , 'src' ,'subjects'));

    }

    /**

     * Show the form for editing the specified resource.

     *

     * @param  App\Test $test

     * @return \Illuminate\Http\Response

     */

    public function edit(Test $test)

    {

        if (Auth::user()->hasAnyRole([0,1]))
        {
            $subjects=Subject::latest()->get();
        }
        else{
            $subjects = Auth::user()->subjects;
        }

        return view('admin.tests.edit',compact('test','subjects'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  App\Test $test

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Test $test)

    {

        //Vaidate Data

        $request->validate([



            'title' => 'required|max:200',

            'term' => 'required|integer',

            'sub_test' => 'required|integer',

            'active' => 'required',

            'type' => 'required',

        ]);



        $test->title = $request->title ;

        $test->term = $request->term;

        $test->sub_test =$request->sub_test;

        $test->active =$request->active ? true : false ;

        $test->type = $request->type;



        //$test->order = $request->order ;



//        if($request->hasFile('src')) {

//            Storage::delete($test->src);

//            $test->src = $request->src->store('public/tests');

//        }





        if ($request->hasFile('src'))

        {

            $extention = $request->file('src')->getClientOriginalExtension();

            //dd($extention,$request->type);



            if($extention === 'jpg'&&$request->type ==='image'|| $extention === 'png' && $request->type ==='image')

            {

                $test->src = $request->src->storeAs('public/tests', time().$request->src->getClientOriginalName());

            }

            elseif($extention === 'pdf' && $request->type ==='pdf')

            {

                $test->src = $request->src->storeAs('public/tests', time().$request->src->getClientOriginalName());

            }

            elseif($extention === 'docx' && $request->type ==='word')

            {

                $test->src = $request->src->storeAs('public/tests', time().$request->src->getClientOriginalName());

            }

            else

            {return redirect()->back()->withError('يرجى اختيار الملف من النوع المحدد');}

        }

        if($request->type ==='video' )

        {
            if($request['src']!=''&&$request['src']!=' '&&$request['embadedCode_src']!=''&&$request['embadedCode_src']!=null){
                return "#";
                $test->src  = $request->embadedCode_src ;
            }


        }

        //save changes

        $test->save();



        if($request->subject_id !="-- اختر مادة --"){

            $test->subjects()->syncWithoutDetaching($request->subject_id);

        }

        //Return redirect

        return redirect()

            ->route('test.show', ['test' => $test->id])

            ->with('success', 'تم تعديل الاختبار بنجاح');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  App\Test $test

     * @return \Illuminate\Http\Response

     */

    public function destroy(Test $test)

    {



        //Delete The test file

        Storage::delete($test->src);







        //Delete test from db

        $test->delete();





//        return redirect()->back()

//            ->with('success','تم حذف الاختبار بنجاح');



        return redirect()->route('test.index')

            ->with('success','تم حذف الاختبار بنجاح');





    }



    /**

     * Activate A Test

     *  @param \App\Test $test

     *  @return \Illuminate\Http\Response

     */

    public function activate(Request $request, Test $test){



        $test->activate();



        $test->save();



        return back()

            //->route('tets.show', ['test' => $test->id])

            ->with('success','تم تفعبل الإختبار بنجاح');



    }





    /**

     * Deactivate A Test

     *

     * @param \App\Test $test

     * @return \Illuminate\Http\Response

     */

    public function deactivate(Request $request, Test $test){



        $test->deactivate();



        $test->save();



        return back()

            //->route('test.show', ['test' => $test->id])

            ->with('success','تم إلغاء تفعيل الإختبار بنجاح');

    }





    public function addAttachment(Request $request,Test $test)

    {

        $attachment_id = $request->attachment_id;

        $attachment = Attachment::find($attachment_id);

        $attachment->attachmentable()->syncWithoutDetaching($test);



        //Return redirect

        return redirect()

            ->route('test.show', ['test' => $test->id])

            ->with('success', 'تم إضافة مرفق بنجاح');



    }



}

