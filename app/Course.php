<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'active'
    ];



    /**
     * Lessons belongs to this course
     */
    public function lessons(){

        return $this->belongsToMany('App\Lesson','course_lesson')
                ->withTimestamps();
    }


    /**
     * Advices belonging to this course
     */
    public function advices(){

        return $this->belongsToMany('App\Advice','advice_course');
        
    }

    /**
     * WhatsApp Links belonging to this course
     */
    public function links(){

        return $this->morphMany('App\WhatsappLink','linkable','linkable_type','linkable_id');
    }

    /**
     * Teachers who teaches This Course
     */
    public function teachers(){

        return $this->belongsToMany('App\Teacher','course_teacher','course_id','teacher_id')
            ->withTimestamps();
    }

    /**
     * Students belonging to this Course
     */
    public function students(){

        return $this->belongsToMany('App\Student','course_student','course_id','student_id')
                ->withTimestamps();
    }


    //Operations On Courses 
    public function makeActive(){

        $this->active = true ; 
        
        
    }

    //Deactivate A Course 
    public function makeInactive(){

        $this->active = false ; 
       
    }
}
