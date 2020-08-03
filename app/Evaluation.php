<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    //guarded Attributes
    protected $guarded = ['id','created_at','updated_at'];



    //Evaluated Lessons
    public function lesson(){

        return $this->belongsTo('App\Lesson');
    }


    //Evaluating Student
    public function student(){

        return $this->belongsTo('App\User');
    }
    
}
