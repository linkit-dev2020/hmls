<?php

namespace App\Http\Controllers\Course;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;use App\RequestCourse;
use App\User;
use App\CourseStudent;
use Auth;
use Illuminate\Support\Facades\DB ;
use App\Lesson ;
class CoursesController extends Controller
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


        $courses = null ;
        $mycourses = null;
        if (Auth::user()->hasRole(2))
        {
           $mycourses = Auth::user()->courses;
        }
        elseif (Auth::user()->hasRole(3))
        {
           $mycourses = Auth::user()->coursess;
           $courses = Course::query()->where('active' , 1)->get();
        }elseif (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)){
           $courses = Course::all();
        }
        //Prepare for Search Courses

        if(request()->has('title')){
            $coursesQuery->where('title','like','%' .request('title') . '%');
        }

        //$courses = $coursesQuery->get();
        //Prepare for Ajax Calls
        if(request()->wantsJson()){
            return $courses ;
        }
        if($courses)
            $courses=$courses->sortBy('order_num');
        return view('admin.courses.index', compact('courses','mycourses'));
    }

    /**
     * Show the form for creating a new Course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.courses.create');
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
            'title' => 'required|max:200|unique:courses',
            'active' => 'boolean'
        ]);

        //Prepare data
        $data['title'] = $request->title ;
        $data['order_num'] = $request->order;

        $data['active'] = $request->active ? true : false ;


        //Store Data
        $course = Course::create($data);
        $course->order_num=$data['order_num'];
        $course->stunum=$request->stunum;
        $course->save();


        //Return to the Class Show page With Success Message


        return redirect()->route('course.show', ['course' => $course->id])
                ->with('success', 'تم إنشاء الدورة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {


        $teachers = Role::find(2)->users()->get();

        $teachersCourse = Course::find($course->id)->teachers()->get();
        $Alllessons = Lesson::all();
        //prepare for AjaxCall
        if(request()->wantsJson()){

            return $course ;
        }
		$students=$course->students;
        $lessons = $course->lessons;
        $courseAdvices = $course->advices;
        return view('admin.courses.show' , compact('course','lessons','teachersCourse',
            'teachers', 'courseAdvices','Alllessons','students'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {

        return view('admin.courses.edit' , compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {

        //Validate Data
        $request->validate([
            'title' => 'required|max:200',
            'active' => 'boolean'

        ]);

        //Prepare data

        $data['title'] = $request->title ;

        $data['active'] = $request->active ? true : false ;

        $data['order_num'] = $request->order;

        //Update Course
        $course->title = $data['title'];
        $course->active = $data['active'];
        $course->order_num = $data['order_num'];
        $course->stunum=$request->stunum;


        $course->save();



        //Redirect with updated Data
        return redirect()->route('course.show',['course' => $course->id])
            ->with('success','تم تعديل الدورة بنجاح');



    }

    /**
     * Remove the specified Course from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();


        return redirect()->route('course.index')
                    ->with('success','تم حذف الدورة بنجاح');


    }

    /**
     * Action to Activate A Course
     */
    public function activate(Course $course){

        $course->makeActive();

        $course->save();

        return redirect()->route('course.show', ['course' => $course->id])
                ->with('success','تم تفعيل الدورة بنجاح');
    }

     /**
      * Action to deactivate A Course
      */
      public function deactivate(Course $course){
        $course->makeInactive();
        $course->save();

        return redirect()->route('course.show', ['course' => $course->id])
                ->with('success', 'تم إلغاء تفعيل الدورة بنجاح');

      }



    public function addStudent(Request $request)
    {
        $class=Course::find($request->cid);
        $class->students()->syncWithoutDetaching(User::find($request->sid));
        return redirect()->back();
    }


      public function addLesson(Request $request ,Course $course)
    {

        $lesson = Lesson::find($request->lesson);
        //$unit->lessons()->save($lesson,['lesson_order'=>$unit->lessons()->count()+1]);
        $course->lessons()->syncWithoutDetaching($lesson);
        //$lessons = Lesson::with('techers');

        return redirect()
            ->back()
            ->with('success', 'تم اضافة الدرس بنجاح');
    }

    public function storeLesson(Request $request,Course $course)
    {
        $lesson = Lesson::find($request->lesson_id);
        $course->lessons()->attach($lesson);

        //Redirect with status
        return redirect()
                ->route('course.show',['course' => $course->id])
                ->with('success','تم تعديل الدورة بنجاح');
    }

    public function deleteLesson(Request $request , Course $course)
    {
        $lesson = Lesson::find($request->lesson_id);
        $course->lessons()->detach($lesson);
        //Redirect with status
        return redirect()
                ->route('course.show',['course' => $course->id])
                ->with('success','تم تعديل  الدورة بنجاح');
    }

    public function addteacher(Request $request, Course $course)
    {
        $teacher = User::where('id',$request->teacher)->get();
        //dd($teacher);
        $course->teachers()->syncWithoutDetaching($teacher);

        //Return redirect
        return redirect()
            ->route('course.show', ['course' => $course->id])
            ->with('success', 'تم اضافة المدرس للدورة الدراسية بنجاح');
    }

    public function deleteTeacher( Course $course ,Request $request )
    {
        //$teacher = User::where('id',$request->teacher)->get();

        $request->course->teachers()->detach($request->teacher_id);

        //Return redirect
        return redirect()
            ->back()
            ->with('success', 'تم فصل المدرس عن الدورة الدراسية بنجاح');
    }

    public function deleteStudent( Course $course ,Request $request )
    {
        //$teacher = User::where('id',$request->teacher)->get();

        $course->students()->detach($request->student_id);		$match=['course_id'=>$course->id,'student_id'=>$request->student_id];
		$req=RequestCourse::where($match)->delete();
        //Return redirect
        return redirect()
            ->back()
            ->with('success', 'تم فصل الطالب عن الدورة الدراسية بنجاح');
    }

	public function deleteAllStudents(Course $course,Request $request)
	{

		foreach($course->students as $st)
		{
			$match=['course_id'=>$course->id,'student_id'=>$st->id];
			$req=RequestCourse::where($match)->delete();
			CourseStudent::where($match)->delete();
		}

        //Return redirect
        return redirect()
            ->back()
            ->with('success', 'تم فصل جميع الطلاب');
	}

//////////////
    public function myCourses(Request $request)
    {
        $user_id = auth()->user()->id;

        $student_courses= DB::table('course_student')->where('student_id', $user_id)->get();

        $courses = array();

        foreach ($student_courses as $coursObj) {
            $studentCourse =  Course::find($coursObj->course_id);
            array_push($courses, $studentCourse);
        }


        if (request()->expectsJson()) {

            return $courses;
        }
        return view('admin.courses.mycourses' , compact('courses'));


        //TODO FrontEn Developer
        //Load admin.classes.index view with $classes
    }
}
