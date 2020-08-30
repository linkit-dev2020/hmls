<?php

namespace App\Http\Controllers\Subject;

use App\Subject;
use App\ClassRoom ;
use App\Conversation;
use App\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Auth;
use Storage ;
use File;

class SubjectsController extends Controller
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


        //Fetch all the subjects from teh database
        $subjectsQuery = Subject::all()->sortBy('order_num');

        //handle parameter limit
        if(request()->has('take')){

            $subjectsQuery->take(request()->take) ;
        }

        if (Auth::user()->hasAnyRole([0,1]))
        {
         $subjects = $subjectsQuery;
        }
        else{
            $subjects = Auth::user()->subjects;
        }
        //return view with subjects passed

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form fRor creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Fetch Classes to pass them to dropdown box

        $selectedclass = $request->has('selectedclass') ? ClassRoom::findOrFail($request->selectedclass): null ;
        $classes = ClassRoom::all();

        return view('admin.subjects.create', compact('classes' , 'selectedclass'));
    }

    /**
     * Store a newly created Subject in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validate Data
        $request->validate([
            'name' => 'required|max:200',
            'class_id' => 'required'
        ]);


        //Prepare Data to persist
		$sb=new Subject();
		$sb->name=$request->name;
		$sb->downloable=$request->downloable?true:false;
		$sb->active=$request->active?true:false;
		$sb->class_id=$request->class_id;
        $attributes['name'] = $request->name ;
        $attributes['downloable'] = $request->downloable ? true : false ;

        $attributes['active'] = $request->active ? true : false ;

        $attributes['class_id'] = $request->class_id ;
        $attributes['order_num'] = $request->order ;
		$attributes['cover']=$request->file('cover')->store('public/covers');
		//if($request->hasFile('cover')){
                    //$attributes['src'] = $request->src->store('public/carousels');
          //      $attributes['cover'] = $request->cover->storeAs('public/subjects', $request->cover->getClientOriginalName());
                //$attributes['cover'] = "qwer";
        //}
        //Persist Data in the database

       $subject =  Subject::create($attributes);

        //Redirect to the Subject Page
        return redirect()
               ->route('subject.show', ['subject' => $subject->id])
               ->with('success','تم  إنشاء المادة الدراسية بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $teachers = Role::find(2)->users()->get();

        $teachersSubject = Subject::find($subject->id)->teachers()->get();
        $tests = Test::all() ;
        $subjectTests = $subject->tests;
        $convs =Conversation::where('subject',$subject->id)->get();
        //Return a view with Subejct Model
        return view('admin.subjects.show', compact('subject','teachersSubject','teachers' ,
            'tests', 'subjectTests','convs'));
    }

    public function attachTest(Request $request,Subject $subject)
    {
        $test = Test::find($request->test);
        //$unit->lessons()->save($lesson,['lesson_order'=>$unit->lessons()->count()+1]);

         $subject->tests()->syncWithoutDetaching($test);
       //  $subject->tests()->save($test , );
        //$order->product()->save($product, ['price' => 12.34]);

        //Redirect with status
        return redirect()
            ->route('subject.show',['subject' => $subject->id])
            ->with('success','تم تعديل المادة بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //Fetch All Classes
        $classes = ClassRoom::all();

        return view('admin.subjects.edit', compact('subject', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|max:200',
            'class_id' => 'required|integer'
        ]);


        //Prepare Data
            $subject->name = $request->name ;

            $subject->class_id = $request->class_id ;
            $subject->order_num = $request->order;

            $subject->active = $request->active ? true : false ;

            $subject->downloable = $request->downloable ? true : false ;

			if($request->hasFile('cover')) {
                Storage::delete($subject->cover);
                $subject->cover = $request->file('cover')->store('public/covers');
            }
        //Persist Data
        $subject->save();

        //Redirect with Status
        return redirect()
               ->route('subject.show',['subject' => $subject->id])
               ->with('success', 'تم تعديل المادة الدراسية بنجاح');
    }

    /**
     * Remove the specified Subject from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {

        //Delete The lesson file
        Storage::delete($subject->src);

        //Delete lesson from db
        $subject->delete();

        return redirect()->route('subject.index')
       ->with('success','تم حذف المادة الدراسية ب نجاح'   );

    }

    /**
     * Activate A Subject
     *  @param \App\Subject $subject
     *  @return \Illuminate\Http\Response
     */
    public function activate(Request $request, Subject $subject){

        $subject->activate();

        $subject->save();

        return back()
                //->route('subject.show', ['subject' => $subject->id])
                ->with('success','تم تفعبل المادة بنجاح');

    }


    /**
     * Deactivate A Subject
     *
     * @param \App\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request, Subject $subject){

        $subject->deactivate();

        $subject->save();

        return back()
                //->route('subject.show', ['subject' => $subject->id])
                ->with('success','تم إلغاء تفعيل المادة بنجاح');
    }

    public function addteacher(Request $request, Subject $subject)
    {
        $teacher = User::where('id',$request->teacher)->get();
        //dd($teacher);
        $subject->teachers()->syncWithoutDetaching($teacher);

        $units = $subject->units ;
         foreach ($units as $unit){
             $lessons = $unit->lessons ;
             foreach($lessons as $lesson ){
                 $lesson->teachers()->syncWithoutDetaching($teacher);
             }
         }

        //Return redirect
        return redirect()
            ->route('subject.show', ['subject' => $subject->id])
            ->with('success', 'تم اضافة المدرس للمادة بنجاح');
    }

    public function deleteTeacher( Subject $subject ,Request $request )
    {
        //$teacher = User::where('id',$request->teacher)->get();

        $request->subject->teachers()->detach($request->teacher_id);

        //Return redirect
        return redirect()
            ->route('subject.show', ['subject' => $subject->id])
            ->with('success', 'تم فصل المدرس عن المادة بنجاح');
    }


    public function deleteTest(Request $request , Subject $subject)
    {
        $test = Test::find($request->test_id);
        $subject->tests()->detach($test);
        //Redirect with status
        return back()
            ->with('success', 'تم فصل الاختبار عن المادة بنجاح');

    }

}
