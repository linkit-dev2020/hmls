<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //Mass Assignment Exception 
    protected $fillable = ['name','downloable','active','units_nums','class_id','cover'];

    //Eager Loading Default 
    protected $with = ['class'] ; 
  

     
  

    //A Subject belongs to one Class 
    public function class(){

        return $this->belongsTo('App\ClassRoom','class_id');
    }

    //A Subject has many units 
    public function units(){

        return $this->hasMany('App\Unit');
    }


    /**
     * Lessons belonging to this subject
     */
    public function lessons(){

        return $this->belongsToMany('App\Lesson','lesson_subject')
        ->withTimestamps();
        
    }

    /**
     * Tests belonging to this subject
     */
    public function tests(){

        return $this->belongsToMany('App\Test','subject_test');
    }

    /**
     * Teachers who teaching this subject
     */
    public function teachers(){

        return $this->belongsToMany('App\Teacher','subject_teacher')
                ->withTimestamps();
    }


    /**Model Operations */

    //activate A Subject 
    public function activate(){

        $this->active = true ; 
    }

    //deactivate A Subject 
    public function deactivate(){

        $this->active = false ; 
    }

}
