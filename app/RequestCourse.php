<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestCourse extends Model
{
    protected $guarded = [] ; 

    // Request to a class 
    public function course(){

        return $this->belongsTo('App\Course','course_id');
    }

    //Request belogns to Student 
    public function student(){

        return $this->belongsTo('App\User');
    }
}
