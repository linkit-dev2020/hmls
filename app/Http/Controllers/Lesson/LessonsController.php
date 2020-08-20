<?php

namespace App\Http\Controllers\Lesson;

use App\Attachment;
use App\ClassRoom;
use App\Notifications\NotficationManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Unit;
use App\Lesson;
use App\Comment;
use App\Reply;
use Auth;
use App\Role;
use App\Course;
use App\Evaluation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Storage ;
use File ;
use App\User;
use Illuminate\Support\Facades\Mail;

class LessonsController extends Controller
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
        if (Auth::user()->hasAnyRole([0,1])){
            $lessons = Lesson::all()->sortBy('order_num');
        }else{
            $lessons =  Auth::user()->lessons()->get();
            if($lessons)
                $lessons=$lessons->sortBy('order_num') ;
        }
        return view('admin.lessons.index',compact('lessons'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $selectedCourse = request()->filled('selectedcourse') ? Course::findOrFail(request()->selectedcourse) : null ;
        $selectedUnit = request()->filled('selectedunit') ? Unit::findOrFail(request()->selectedunit) : null ;
        if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole([0,1]))
        {
            $units = Unit::all();
            $courses = Course::all();
            $classes=ClassRoom::all();
        }
        else
        {

            $units=[];
            $courses=[];
            $classes=[];
            foreach (\Illuminate\Support\Facades\Auth::user()->subjects as $subject)
            {
                foreach ($subject->units as $unit)
                {
                    array_push($units,$unit);
                }
                array_push($classes,$subject->class);



            }
            $classes=Collection::make($classes)->unique();

            //return $classes;
            foreach (\Illuminate\Support\Facades\Auth::user()->courses as $course)
            {
                array_push($courses,$course);
            }


        }
        return view('admin.lessons.create',compact('selectedUnit','units','selectedCourse','courses','classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Unit $unit = null, Course $course = null)
    {
        $request->validate([
            'title' => 'required|max:200',
            'type' => 'required',
            'active' => 'required',
            'unit_id'=>'required',
            'src' => '',
            'url_src' => '',
            'intro' => 'required'
        ]);

        if ($request->src === null && $request->url_src === null && $request->embadedCode_src === null)
        {
          return redirect()->back()->withError('اختر رابط او ملف');
        }

        $existUrl = Lesson::where('src',$request->url_src)
        ->first();

        $existEmbed =Lesson::where('src',$request->embadedCode_src)
        ->first();


        //if($existUrl != null || $existEmbed != null)
        //{
          //return redirect()->back()->withError('اختر رابط فريد');
        //}

        //Prepare data to save

        // $attributes['title'] = $request->title ;
        // $attributes['type'] = $request->type ;
        // $attributes['active'] = $request->active ? true : false ;
        // $attributes['intro'] = $request->intro ;

        // //save File
        // if($request->hasFile('src')){

        //     $attributes['src'] = $request->src->storeAs('public/lessons', $request->src->getClientOriginalName());

        // }

        //  //Persist data in the database
        //  $lesson = Lesson::create($attributes);

        $lesson = new Lesson();

        $lesson->type = $request->type;
        //handle upload file to lesson or set URL
        if ($request->hasFile('src'))
          {
              $extention = $request->file('src')->getClientOriginalExtension();
              //dd($extention,$request->type);

               if($extention === 'jpg'&&$request->type ==='image'|| $extention === 'png' && $request->type ==='image')
               {
                 $lesson->src = $request->src->storeAs('public/lessons', time().$request->src->getClientOriginalName());
               }
               elseif($extention === 'pdf' && $request->type ==='pdf')
               {
                 $lesson->src = $request->src->storeAs('public/lessons', time().$request->src->getClientOriginalName());
               }
               elseif($extention === 'docx' && $request->type ==='word')
               {
                 $lesson->src = $request->src->storeAs('public/lessons', time().$request->src->getClientOriginalName());
               }
               else
               {return redirect()->back()->withError('يرجى اختيار الملف من النوع المحدد');}
          }
          elseif($request->url_src != null) {
            $lesson->src = $request->url_src;
          }elseif($request->embadedCode_src !=null) {
            $lesson->src = $request->embadedCode_src;
            $lesson->isLive = $request->isLive=='on'?1:0;
            $lesson->start = $request->start;
          }

        $lesson->title = $request->title;

        $lesson->active = $request->active;
        $lesson->intro = $request->intro;

        $lesson->order_num=$request->order;
        $lesson->save();


         if($request->unit_id != 0&& $request->unit_id != null){

            //$arr= $lesson->fresh()->unit->pluck('pivot.lesson_order')->toArray();
            //$lesson->fresh()->units[1]->pivot->lesson_order = 1 ;
            $lesson->units()->syncWithoutDetaching($request->unit_id ,['pivot.lesson_order'=>1]);
            NotficationManager::notifyNewLessonClass(Unit::find($request->unit_id)->subject);
         }
         if($request->course_id != "-- اختر الدورة --" && $request->course_id != null){
            $lesson->courses()->syncWithoutDetaching($request->course_id);
        }
        if(Auth::user()->hasRole(2)){
        $lesson->teachers()->syncWithoutDetaching(Auth::user()->id);
        //Auth::user()->lessons()->syncWithoutDetaching($lesson->id);
        }
        if($request->isLive == 'on')
        {
             $this->sendMails($request->unit_id,$request->start);
        }
         //Return redirect
        return redirect()
        ->route('lesson.show', ['lesson' => $lesson->id])
        ->with('success', 'تم إنشاء الدرس بنجاح');
    }
    public function sendMails($course_id, $start)
    {
        $unit = Unit::find($course_id);
        $students = $unit->subject()->first()->class()->first()->students()->get();

        foreach($students as $st)
        {
            // mail

            $to_name = $st->full_name;
            $to_email = $st->tc;
            $data = [
                'date'=>$start,
                'name' => $to_name,
                'subject'=>$unit->subject()->first()->name,
            ];
            Mail::send('mail.dates', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('محاضرة بث مباشر');
                $message->from('info@hlms.com','HLMS');
            });
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        $teachersLesson = $lesson->teachers;
        $teachers = Role::find(2)->users()->get();
        $comments = $lesson->comments()->with('commenter')->get();
        //$comments = Comment::where('lesson_id',$lesson->id)->get();
        $ratings = $lesson->evaluations;
        $studentEvaluation = null;
        $eva_value = 0;
        if (Auth::user()->hasRole(3)) {

            //$evaluations = Auth::user()->evaluations;
            $evaluations = Evaluation::whereHas('student', function($query) {
                $query->where('student_id', '=', Auth::user()->id);
            })->get();
            //dd( $evaluations);
            foreach($evaluations as $evaluation) {
                if($lesson->id === $evaluation->lesson_id) {
                    $studentEvaluation = $evaluation;
                    $eva_value = $evaluation->value;
                }
            }
        }
        $attachments = Attachment::where('attachmentable_id',$lesson->id)->get();
        return view('admin.lessons.show',compact('lesson', 'comments', 'ratings','attachments','studentEvaluation', 'eva_value','teachersLesson','teachers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Lesson $lesson)
    {

        $units = Unit::all();
        $courses = Course::all();

        if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole([0,1]))
        {
            $units = Unit::all();
            $courses = Course::all();
            $classes=ClassRoom::all();
        }
        else
        {

            $units=[];
            $courses=[];
            $classes=[];
            foreach (\Illuminate\Support\Facades\Auth::user()->subjects as $subject)
            {
                foreach ($subject->units as $unit)
                {
                    array_push($units,$unit);
                }
                array_push($classes,$subject->class);

            }
            $classes=Collection::make($classes)->unique();

            //return $classes;
            foreach (\Illuminate\Support\Facades\Auth::user()->courses as $course)
            {
                array_push($courses,$course);
            }


        }


        return view('admin.lessons.edit',compact('lesson','units','courses','classes'));
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
 /*   public function f1(Request $request, Lesson $lesson)
    {
           $request->validate([
            'type' => 'required',
                 ]);
              $lesson->type = $request->type ;
                      $lesson->save();

                       return redirect();

    }
    */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|max:200',
           'type' => 'required',
            'active' => 'required',
            'intro' => 'required',
            'unit_id'=>'required'

        ]);


        $lesson->title = $request->title ;


        $lesson->intro =$request->intro;
        if($request->type!='none') {
            $lesson->type = $request->type;
            //handle upload file to lesson or set URL
            //handle upload file to lesson or set URL
            if ($request->src === null && $request->url_src === null && $request->embadedCode_src === null) {
                return redirect()->back()->withError('اختر رابط او ملف');
            }
        }

     if ($request->hasFile('src'))
          {

              $extention = $request->file('src')->getClientOriginalExtension();


               if($extention === 'jpg'&&$request->type ==='image'|| $extention === 'png' && $request->type ==='image')
               {
                 $lesson->src = $request->src->storeAs('public/lessons', time().$request->src->getClientOriginalName());
               }
               elseif($extention === 'pdf' && $request->type ==='pdf')
               {
                 $lesson->src = $request->src->storeAs('public/lessons', time().$request->src->getClientOriginalName());
               }
               elseif($extention === 'docx' && $request->type ==='word')
               {
                 $lesson->src = $request->src->storeAs('public/lessons', time().$request->src->getClientOriginalName());
               }
               else
               {return redirect()->back()->withError('يرجى اختيار الملف من النوع المحدد');}
          }

          elseif($request->url_src != null) {
            $lesson->src = $request->url_src;

          }elseif($request->embadedCode_src !=null) {
            $lesson->setSrcAttribute($request->embadedCode_src);
          }
        if($request->unit_id!='-1')
        {
            $lesson->units()->syncWithoutDetaching($request->unit_id ,['pivot.lesson_order'=>1]);
        }
        $lesson->active = $request->active ? true : false ;
        $lesson->order_num=$request->order;
        $lesson->save();

        return redirect()
            ->route('lesson.show', ['lesson' => $lesson->id])
            ->with('success', 'تم تعديل الدرس بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //Delete The lesson file
        Storage::delete($lesson->src);

        //Delete lesson from db
        $lesson->delete();

        return redirect()->back()
       ->with('success','تم حذف الدرس بنجاح');
    }

    public function activate(Lesson $lesson){

        $lesson->makeActive();

        $lesson->save();

        return redirect()->back()
                ->with('success','تم تفعيل الدرس بنجاح');
    }

     /**
      * Action to deactivate A lesson
      */
      public function deactivate(Lesson $lesson){
        $lesson->makeInactive();
        $lesson->save();

        return redirect()->back()
                ->with('success', 'تم إلغاء تفعيل الدرس بنجاح');

      }

      public function addComment(Request $request,Lesson $lesson)
      {
         $request->validate([
             'content' => 'required'
         ]);
         $user = Auth::user();
         $comment = new Comment();
         $comment->content = $request->input('content');
         $comment->commenter_id = $user->id;
		 $comment['parent']=$request->commid;
         if($user->hasRole(Role::ADMIN))
         {
             $comment->commenter_type = 'admin';
         }elseif($user->hasRole(Role::MANAGER))
         {
            $comment->commenter_type = 'manager';
         }elseif($user->hasRole(Role::TEACHER))
         {
            $comment->commenter_type = 'teacher';
         }elseif($user->hasRole(Role::STUDENT))
         {
            $comment->commenter_type = 'student';
         }
         // fire notification
         NotficationManager::notifyNewComment($lesson,$user->username,$user->id);

         // end of notifications
         $comment->lesson_id = $lesson->id;
         $comment->save();

         $baseComm=Comment::find($request->commid);
          if($request->commid!=0)
          {
              NotficationManager::notifyReply($lesson,$user->username,$baseComm->commenter);
         }


         //$lesson->comment()->attach($comment);
        return Redirect::back();
           //Return redirect
        return redirect()
        ->route('lesson.show', ['lesson' => $lesson->id])
        ->with('success', 'تم إضافة تعليق بنجاح');

      }


      public function updateComment(Request $request, Comment $comment ,Lesson $lesson)
      {
        $request->validate([
            'content' => 'required'
        ]);

        $comment->content = $request->input('content');
        $comment->save();
          return Redirect::back();
         //Return redirect
         return redirect()
         ->route('lesson.show', ['lesson' => $lesson->id])
         ->with('success', 'تم تعديل التعليق بنجاح');
      }

      public function deleteComment(Comment $comment,Lesson $lesson)
      {
          $comment->delete();
          return Redirect::back();
           //Return redirect
         return redirect()
         ->route('lesson.show', ['lesson' => $lesson->id])
         ->with('success', 'تم حذف التعليق بنجاح');
      }



      public function addReply(Request $request,Comment $comment,Lesson $lesson)
      {
         $request->validate([
             'content' => 'required'
         ]);

         $user = Auth::user();

         $reply = new Reply();
         $reply->content = $request->input('content');
         $reply->replyer_id = $user->id;

         if($user->hasRole(Role::ADMIN))
         {
             $reply->replyer_type = 'admin';
         }elseif($user->hasRole(Role::MANAGER))
         {
            $reply->replyer_type = 'manager';
         }elseif($user->hasRole(Role::TEACHER))
         {
            $reply->replyer_type = 'teacher';
         }elseif($user->hasRole(Role::STUDENT))
         {
            $reply->replyer_type = 'student';
         }

         $reply->save();



         $comment->replies()->attach($reply);
        return Redirect::back();
           //Return redirect
        return redirect()
        ->route('lesson.show', ['lesson' => $lesson->id])
        ->with('success', 'تم إضافة رد بنجاح');

      }


      public function updateReply(Request $request, Reply $reply ,Comment $comment)
      {
        $request->validate([
            'content' => 'required'
        ]);

        $reply->content = $request->input('content');
        $reply->save();
          return Redirect::back();
         //Return redirect
         return redirect()
         ->route('lesson.show', ['lesson' => $lesson->id])
         ->with('success', 'تم تعديل الرد بنجاح');
      }

      public function deleteReply(Reply $reply,Comment $comment,Lesson $lesson)
      {

          $reply->delete();
          return Redirect::back();
           //Return redirect
         return redirect()
         ->route('lesson.show', ['lesson' => $lesson->id])
         ->with('success', 'تم حذف الرد بنجاح');
      }

      public function createEvaluation(Request $request, $studentEvaluation) {
        DB::transaction(function (){
            $createEvaluation= Evaluation::create([
            'value' => $request->input('rate'),
            ]);
        });
          return redirect()->back()
              ->with('success', 'تم إنشاء تقييم بنجاح');
      }

      public function editEvaluation(Request $request, $evaluation) {
        DB::transaction(function (){
            $evaluation->value = $request->rate;
            $evaluation->save();
        });

          return redirect()->back()
              ->with('success', 'تم تعديل تقييم بنجاح');
      }

      public function addteacher(Request $request, Lesson $lesson)
    {
        $teacher = User::where('id',$request->teacher)->get();
        //dd($teacher);
        $lesson->teachers()->syncWithoutDetaching($teacher);

        //Return redirect
        return redirect()
            ->route('lesson.show', ['lesson' => $lesson->id])
            ->with('success', 'تم اضافة المدرس للدرس بنجاح');
    }

    public function deleteTeacher( Lesson $lesson ,Request $request )
    {
        //$teacher = User::where('id',$request->teacher)->get();

        $request->lesson->teachers()->detach($request->teacher_id);

        //Return redirect
        return redirect()
            ->route('lesson.show', ['lesson' => $lesson->id])
            ->with('success', 'تم فصل المدرس عن الدرس بنجاح');
    }






}
