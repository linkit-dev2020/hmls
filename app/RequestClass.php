<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestClass extends Model
{
    

    protected $guarded = [] ; 
    
    // Request to a class 
    public function class(){

        return $this->belongsTo('App\ClassRoom','class_id');
    }

    //Request belogns to Student 
    public function student(){

        return $this->belongsTo('App\User');
    }
}
