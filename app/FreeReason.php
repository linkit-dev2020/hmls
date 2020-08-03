<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreeReason extends Model
{
    //Guarded Attributes 
    protected $guarded = ['id','created_at','updated_at'];


    //Students belonging to This FreeReason
    public function students(){

        return $this->belongsToMany('App\User','freereason_student','freereason_id','student_id')
        ->withTimestamps();
    }
}
