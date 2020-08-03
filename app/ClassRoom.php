<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    
    protected $fillable = ['name','free','created_at','updated_at'];

    protected $table = 'classes';

    //Eager Loading Default 

    /**
     * Subjects belonging to this Class 
    */   
    public function subjects(){

        return $this->hasMany('App\Subject','class_id');
    }

    /**
     * Lessons belonging to this class
     */
    public function lessons(){

        return $this->belongsToMany('App\Lesson','class_lesson','class_id','lesson_id')
        ->withTimestamps();
        
    }


    /**
     * Advices Belonging to this class
     */
    public function advices(){

        return $this->belongsToMany('App\Advice','advice_class','class_id','advice_id')
                ->withTimestamps();
    }

    /**
     * Denemes Belongin to this Class
     */
    public function denemes(){

        return $this->hasMany('App\Deneme','class_id');
    }

    /**
     * Notes belonging to this ClassRoom
     */
    public function notes(){

        return $this->hasMany('App\Note','class_id');
    }


    /**WhatsApp Links belonging to this Class */
    public function links(){

        return $this->morphMany('App\WhatsappLink','linkable','linkable_type','linkable_id');
    }

    /**Teachers Belonging to this class */
    public function teachers(){

        return $this->belongsToMany('App\Teacher','class_teacher','class_id','teacher_id')
                ->withTimestamps();
            
    }

    /**
     * Students Belonging to this ClassRoom
     */
    public function students(){
        return $this->belongsToMany('App\User','class_student','class_id','student_id')
                    ->withTimestamps();
    }
    //Operations Method 
    //make the Class Free
    public function free(){

        $this->free = true ; 

        return $this ; 
    }
    //Make The Class Priced 
    public function priced(){

        $this->free = false ;

        return $this ; 
    }
    //Add A Subject for the Class 
    public function add($subject){

        $this->subjects()->create($subject);
    }
}
