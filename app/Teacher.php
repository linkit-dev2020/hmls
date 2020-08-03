<?php

namespace App;
use App\User ; 

use Illuminate\Database\Eloquent\Model;

class Teacher extends User 
{

    //Listen to created event to attach it to a teacher Role 

    
    protected $table = 'users';



    /**Comments posted by this teacher */
    public function comments(){

        return $this->morphMany('App\Comment','commenter','commenter_type','commenter_id');
    }

    /**Replier Posted By This Teacher */
    public function replies(){

        return $this->morphMany('App\Reply','replier','replier_type','replier_id');
    }

    /**Classes beloning to this this Teacher */
    public function classes(){

        return $this->belongsToMany('App\ClassRoom','class_teacher','teacher_id','class_id')
            ->withTimestamps();
    }

    /**
     * Subjects Belonging to this Teacher
     */
    public function subjects(){

        return $this->belongsToMany('App\Subject','subject_teacher','teacher_id','subject_id')
            ->withTimestamps();
    }

    /**
     * Courses Belonging to this Teacher 
     */
    public function courses(){

        return $this->belongsToMany('App\Course','course_teacher','teacher_id','course_id')
            ->withTimestamps();
    }

    /**
     * Lessons which this teacher is teaching
     */
    public function lessons(){

        return $this->belongsToMany('App\Lesson','lesson_teacher','teacher_id','lesson_id')
            ->withTimestamps();
    }
}
