<?php

namespace App\Http\Controllers\ClassRoom;

use App\ClassRoom;
use App\ClassTest;
use App\Deneme;
use App\Http\Controllers\Controller;
use App\Note;
use App\Role;
use App\User;
use App\ClassStudent;
use App\RequestClass;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Display a listing of the Class.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //Retrieve All Classes ordered descendant by creating data
        $classes = ClassRoom::all()->sortBy('order_num');
        /// student
        ///             var_dump($studentClass->id) ;

        if (Auth::user()->hasRole(3)) {
            $userId = Auth::user()->id;
//            $classesStu = DB::select('SELECT * FROM `classes` WHERE `id` not in (select `class_id`
// from `class_student` where `student_id` = ' . $userId . ')');

           $values = DB::select('select `class_id` from `class_student` where `student_id` = ' . $userId ) ;

           $strV = array();
           foreach ($values as $value){
                array_push($strV ,$value->class_id);
           }
          $classes = ClassRoom::all()->whereNotIn('id', $strV);
        }
        //Prepare for Ajaxf
        if (request()->expectsJson()) {

            return $classes;
        }

        return view('admin.classes.index')->withClasses($classes);

        //TODO FrontEn Developer
        //Load admin.classes.index view with $classes
    }

    /**
     * Show the form for creating a new Class.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO frontEndDeveloper
        //load admin.classes.create view


        return view('admin.classes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate Data
        $request->validate([
            'name' => 'required|max:100|unique:classes',
            'free' => 'boolean'
        ]);

        //Store Data

        $newClass = ClassRoom::create([
            'name' => $request->name,
            'free' => $request->free,
            'order_num'=>$request->order
        ]);
        $newClass->order_num=$request->order;
        $newClass->stunum=$request->stunum;
        $newClass->save();
        if (request()->wantsJson()) {

            return response()->json(['data' => $newClass], 201);
        }

        //redirect with Session Message
        return redirect()->route('class.index')->with('success', 'تم إنشاء الصف بنجاح');
    }

    /**
     * Display the specified ClassRoom.
     *
     * @param  \App\ClassRoom $classRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $class)
    {

        if (request()->wantsJson()) {

            return $class;
        }

        $teachers = Role::find(2)->users()->get();

        $teachersClass = ClassRoom::find($class->id)->teachers()->get();
        $students = ClassRoom::find($class->id)->students()->get();

        $classAdvices = $class->advices;

        $denemes = Deneme::query()->where('class_id', $class->id)->get();
        $notes = Note::query()->where('class_id' , $class->id)->where('type', 'private')->get();

        //TODO FrontEnd Developer
        //Load admin.classes.show view with the $class Model Intance
        return view('admin.classes.show', compact('class', 'teachers', 'teachersClass',
            'classAdvices', 'denemes', 'notes','students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassRoom $classRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $class)
    {

        //TODO FrontEnd Developer
        //Load admin.classes.edit view with $class data
        return view('admin.classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ClassRoom $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassRoom $class)
    {
        $request->validate([
            'name' => 'required|max:100',
            'free' => 'boolean'
        ]);

        $class->name = $request->name;
        if($request->has('order'))
            $class->order_num=$request->order;
        if ($request->has('free')) {
            $class->free = $request->free;
        } else {
            $class->free = $class->free;
        }

        $class->stunum=$request->stunum;
        $class->save();
        return redirect()->route('class.index')
            ->with('success', 'تم تعديل الصف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassRoom $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassRoom $class)
    {

        //if(($class->units()->exists()!=null)) return redirect()->route('class.index')->with('error','لايمكن حذف الصف يجب افراغ الصف أولاً');
        if(($class->advices()->exists()!=null)) return redirect()->route('class.index')->with('error','لايمكن حذف الصف يجب افراغ الصف أولاً');
        if(($class->lessons()->exists()!=null)) return redirect()->route('class.index')->with('error','لايمكن حذف الصف يجب افراغ الصف أولاً');
        if(($class->denemes()->exists()!=null)) return redirect()->route('class.index')->with('error','لايمكن حذف الصف يجب افراغ الصف أولاً');
        if(($class->notes()->exists()!=null)) return redirect()->route('class.index')->with('error','لايمكن حذف الصف يجب افراغ الصف أولاً');
        if(($class->subjects()->exists()!=null)) return redirect()->route('class.index')->with('error','لايمكن حذف الصف يجب افراغ الصف أولاً');
        if(($class->teachers()->exists()!=null)) return redirect()->route('class.index')->with('error','لايمكن حذف الصف يجب افراغ الصف أولاً');
        if(($class->students()->exists()!=null)) return redirect()->route('class.index')->with('error','لايمكن حذف الصف يجب افراغ الصف أولاً');
        if(($class->links()->exists()!=null)) return redirect()->route('class.index')->with('error','لايمكن حذف الصف يجب افراغ الصف أولاً');



        $class->delete();
        return redirect()->route('class.index')
            ->with('success', 'تم حذف الصف بنجاح');
    }

    public function free(ClassRoom $class)
    {
        //Make The Class Free
        $class->free();


        $class->save();

        return redirect()->route('class.show', [
            'class' => $class->id
        ])
            ->with('success', 'تم تعديل الصف ليكون مجاني');

    }

    public function priced(ClassRoom $class)
    {

        //Make the Class priced
        $class->priced();

        $class->save();

        return redirect()->route('class.show', ['class' => $class->id])
            ->with('success', 'تم تعديل الصف ليكون مدفوع');
    }
    public function addStudent(Request $request)
    {
        $class=ClassRoom::find($request->cid);
        $class->students()->syncWithoutDetaching(User::find($request->sid));
        return redirect()->back();
    }
    public function addteacher(Request $request, ClassRoom $class)
    {
        $teacher = User::where('id', $request->teacher)->get();
        //dd($teacher);
        $class->teachers()->syncWithoutDetaching($teacher);

        //Return redirect
        return redirect()
            ->route('class.show', ['class' => $class->id])
            ->with('success', 'تم اضافة المدرس للصف بنجاح');
    }

    public function deleteTeacher(ClassRoom $class, Request $request)
    {
        //$teacher = User::where('id',$request->teacher)->get();

        $class->teachers()->detach($request->teacher_id);

        //Return redirect
        return redirect()
            ->back()
            ->with('success', 'تم فصل المدرس عن الصف بنجاح');
    }

    public function deleteStudent(ClassRoom $class, Request $request)
    {
        //$teacher = User::where('id',$request->teacher)->get();

        $class->students()->detach($request->student_id);

		$match=['class_id'=>$class->id,'student_id'=>$request->student_id];
		$req=RequestClass::where($match)->delete();

        //Return redirect
        return redirect()
            ->back()
            ->with('success', 'تم فصل الطالب عن الصف بنجاح');
    }

	public function deleteAllStudents(ClassRoom $class,Request $request)
	{

		foreach($class->students as $st)
		{
			$match=['class_id'=>$class->id,'student_id'=>$st->id];
			$req=RequestClass::where($match)->delete();
			ClassStudent::where($match)->delete();
		}

        //Return redirect
        return redirect()
            ->back()
            ->with('success', 'تم فصل جميع الطلاب');
	}
    public function myclasses(Request $request)
    {
        $user_id = auth()->user()->id;

        $student_classes = DB::table('class_student')->where('student_id', $user_id)->get();

        $classes = array();

        foreach ($student_classes as $classObj) {
            $studentClass = ClassRoom::find($classObj->class_id);
            array_push($classes, $studentClass);
        }

        if (request()->expectsJson()) {

            return $classes;
        }

        return view('admin.classes.myclasses')->withClasses($classes);

        //TODO FrontEn Developer
        //Load admin.classes.index view with $classes
    }

    public function showMyClass(Request $request,$id)
    {
        //Retrieve All Classes ordered descendant by creating data


        //  $subjects = $class->subjects() ;
        $class = ClassRoom::find($request->id);
        $denemes  = $class->denemes;
        $subjects = $class->subjects ;
//        $denemes = DB::table('denemes')->where('class_id', $request->id)->get();
//        $subjects = DB::table('subjects')->where('class_id', $request->id)->get();

//        //Prepare for Ajax
//        if(request()->expectsJson()){
//
//            return $classes ;
//        }
        $notes = Note::query()->where('class_id' , $class->id)->where('type', 'private')->get();
        return view('admin.classes.showMyClass', compact('subjects', 'class', 'denemes','notes'));

        //TODO FrontEn Developer
        //Load admin.classes.index view with $classes
    }

    public function updateQuizz(Request $request,$id) {
        $json = $request->json;
        $subject = ClassTest::where('class_id',$id)->get();
        if(!is_null($subject->first()))
        {
            $subject = $subject->first();
        }
        else
        {
            $subject=new ClassTest();
        }
       // dd($subject);
        $subject->test = $json;
        $subject->class_id = $id;
        $subject->save();

        return "success";
    }

    public function getQuizz($id) {
        $subject = ClassTest::where('class_id',$id)->get();
        if(!is_null($subject))
        {
            $subject = $subject->first()->test;
            return $subject;

        }
        return "";
    }
}
