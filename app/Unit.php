<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    
    protected $fillable = ['title','active','subject_id'];

    //Eager Loading Default 
   protected $with = ['lessons'];

    //A Unit belongs to A Subject
    public function subject(){

        return $this->belongsTo('App\Subject');
    }


    /**
     * Fetch the lessons that belongs to this unit
     */
    public function lessons(){

        return $this->belongsToMany('App\Lesson','lesson_unit')
        
        ->withTimestamps(); 
        
    }


    //Units Operations 
    //activate unit 
    public function activate(){


        $this->active = true ;
    }

    //deactivate Unit 
    public function deactivate(){

        $this->active = false ; 
    }
}
