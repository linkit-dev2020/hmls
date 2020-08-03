<?php



namespace App\Http\Controllers\Unit;



use App\Notifications\NotficationManager;
use App\Unit;

use App\ClassRoom;

use App\Subject;

use App\Lesson;

use Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Role;
use Illuminate\Support\Collection;


class UnitsController extends Controller

{



    public function __construct()

    {



    $this->middleware('auth');



    }



    /**

     * Display a listing of the Unit.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        //fetch All Units Ordered from last to oldest

         $units = Unit::all()->sortBy('order_num');
         if(!\Illuminate\Support\Facades\Auth::user()->hasAnyRole([0,1]))
         {
             $units=[];
             foreach(\Illuminate\Support\Facades\Auth::user()->subjects as $sub)
             {
                 foreach ($sub->units as $unit)
                 {
                     array_push($units,$unit);
                 }
             }
         }
        // foreach($units as $unit) {

        //     $lessonsCount = DB::where()->count();

        // }



        return view('admin.units.index' , compact('units'));



    }



    /**

     * Show The Form to Choose A Class

     */

    public function chooseClass(){



        $classes = ClassRoom::all();





        return view('admin.units.chooseClass', compact('classes'));

    }



    /**

     * Show the form for creating a new Unit.

     *

     * @return \Illuminate\Http\Response

     */

    public function create(Request $request)

    {

        //Fetch All Classes



        $selectedSubject = request()->filled('selectedsubject') ? Subject::findOrFail(request()->selectedsubject) : null ;
        $classes=[];
        if (Auth::user()->hasAnyRole([0,1]))
        {
            $subjects=Subject::latest()->get();
            $classes=ClassRoom::all()->sortBy('order_num');
        }
        else{
            $subjects = Auth::user()->subjects;
            foreach ($subjects as $subject)
            {
                array_push($classes,$subject->class);
            }
            $classes=Collection::make($classes)->unique();
        }
        //Return View to render All Classes
        return view('admin.units.create', compact('selectedSubject','subjects','classes'));

    }



    /**

     * Store a newly created Unit in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        //Vaidate Data

        $request->validate([



            'title' => 'required|max:200',

            'subject_id' => 'required'



        ]);





        //Prepare data to save



        $attributes['title'] = $request->title ;

        $attributes['active'] = $request->active ? true : false ;

        $attributes['subject_id'] = $request->subject_id ;
        //Persist data in the database

        $unit = new Unit();
        $unit->subject_id= $attributes['subject_id'];
        $unit->title=$attributes['title'];
        $unit->order_num = $request['order_num'];
        $unit->active = $attributes['active'];
        $unit->save();
        $sub=Subject::find($request->subject_id);
        NotficationManager::notifyNewUnit($sub,\Illuminate\Support\Facades\Auth::user());


        //Return redirect

        return redirect()

            ->route('unit.show', ['unit' => $unit->id])

            ->with('success', 'تم إنشاء الوحدة الدسية بنجاح');

    }



    /**

     * Display the specified resource.

     *

     * @param  \App\Unit  $unit

     * @return \Illuminate\Http\Response

     */

    public function show(Unit $unit)

    {

        // $user = Auth::user()->with(['lessons' => function($query){

        //     $query->where()

        // }])->get();



        // $lessons = Lesson::with(['teachers' => function($query){

        //     $query->where('teacher_id', Auth::user()->id);

        // }])->get();

        if (Auth::user()->hasRole(2)){

        $lessons = Auth::user()->lessons;

        }

        else{

            $lessons = Lesson::all();

        }

        //dd($lessons);

        //$unitLessons = Lesson::with(['units'])->get();

        $unitLessons = $unit->lessons->sortBy('order_num');

        //dd($unitLessons);





        //$lessons = array_diff($lessons, $unitLesson);





        return view('admin.units.show', compact('unit','lessons','unitLessons'));

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Unit  $unit

     * @return \Illuminate\Http\Response

     */

    public function edit(Unit $unit)

    {
        $classes=[];
        if (Auth::user()->hasAnyRole([0,1]))
        {
            $subjects=Subject::latest()->get();
            $classes=ClassRoom::all();
        }
        else{
            $subjects = Auth::user()->subjects;
            foreach ($subjects as $subject)
            {
                array_push($classes,$subject->class);
            }
            $classes=Collection::make($classes)->unique();
        }


        return view('admin.units.edit', compact('unit' , 'subjects','classes'));



    }



    /**

     * Update the specified Unit in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Unit  $unit

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Unit $unit)

    {

        //Validate data

        $request->validate([

            'title' => 'required|max:200',

            'subject_id' => 'required'

        ]);



        //Prepare Data

        $unit->title = $request->title ;



        $unit->active = $request->active ? true : false ;




        $unit->order_num=$request['order_num'];
        $unit->subject_id = $request->subject_id ;



        //Update The Resource

        $unit->save();



        //Redirect with status

        return redirect()

                ->route('unit.show',['unit' => $unit->id])

                ->with('success','تم تعديل الوحدة الدرسية بنجاح');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Unit  $unit

     * @return \Illuminate\Http\Response

     */

    public function destroy(Unit $unit)

    {

        $unit->delete();





        return redirect()

                ->back()

                ->with('success','تم حذف الوحدة الدرسية بنجاح');



    }



    /**

     * Activate The Specified Unit

     */

    public function activate(Unit $unit){



        $unit->activate();



        $unit->save();



        return back()

                ->with('success','تم تفعيل الوحدة الدرسية بنجاح');

    }





    /**

     * Deactivate The Specified Unit

     */

    public function deactivate(Unit $unit){



        $unit->deactivate();

        $unit->save();



        return back()

                ->with('success','تم إلغاء تفعيل الوحدة الدرسية بنجاح') ;



    }



    // public function addLesson(Unit $unit)

    // {

    //     $user = Auth::user();



    //     $lessons = $user->lessons();





    //     //$lessons = Lesson::with('techers');



    //     return view('admin.units.addlesson',compact('unit','lessons'));

    // }



    public function attachLesson(Request $request,Unit $unit)

    {

        $lesson = Lesson::find($request->lesson);

        //$unit->lessons()->save($lesson,['lesson_order'=>$unit->lessons()->count()+1]);

        $unit->lessons()->syncWithoutDetaching($lesson);

        //$order->product()->save($product, ['price' => 12.34]);



        //Redirect with status

        return redirect()

                ->route('unit.show',['unit' => $unit->id])

                ->with('success','تم تعديل الوحدة الدرسية بنجاح');

    }



    public function deleteLesson(Request $request , Unit $unit)

    {



        $unit->lessons()->detach($request->lesson_id);



        //Redirect with status

        return redirect()

                ->route('unit.show',['unit' => $unit->id])

                ->with('success','تم تعديل الوحدة الدرسية بنجاح');

    }





}

