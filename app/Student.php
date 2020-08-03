<?php

namespace App;
use App\User ; 
use Illuminate\Database\Eloquent\Model;

class Student extends User
{
    
    protected $table = 'users';

    protected $withCount = ['freeReasons'];


    //TODO:: Use Boot method to attach it a role of Student when Created 

    //Test it 
    //Method to determine if the student is Free 
    public function isFree(){

        return $this->freeReasons_count > 1 ; 
    }


    /**Free Reasons belonging to this Student */

    public function freeReasons(){


        return $this->belongsToMany('App\FreeReason','freereason_student','student_id','freereason_id')
        ->withTimestamps();
    }

    /**Evaluations By This student */
    public function evaluations(){


        return $this->hasMany('App\Evaluation');
    }

    /**
     * Comments posted by this student
     */
    public function comments(){

        return $this->morphMany('App\Comment','commenter','commenter_type','commnter_id');
    }

    /**
     * Replies Posted by this student
     */
    public function replies(){
        return $this->morphMany('App\Reply','replier','replier_type','replier_id');
    }


    /**Fetch All The WhatsApp Links the student has clicked on already */
    public function whatsappLinks(){

        return $this->belongsToMany('App\WhatsappLink','whatsapplink_student','student_id','whatsapplink_id')
        ->withTimestamps();
    }


    /**
     * Classes this studnet is enrolled into
     */
    public function classes(){

        return $this->belongsToMan('App\ClassRoom','class_student','student_id','class_id')
                    ->withTimestamps();
    }

     /**
      * Courses this student is enroleed into
      */
      public function courses(){

        return $this->belongsToMany('App\Course','course_student','student_id','course_id')
                ->withTimestamps();
      }
}
