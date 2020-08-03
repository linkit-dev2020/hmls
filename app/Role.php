<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //constants 
    const ADMIN = 0 ; 
    const MANAGER = 1 ; 
    const TEACHER = 2 ; 
    const STUDENT = 3 ; 

    //guarded Attributes
    
    protected $fillable = [];


    //Users belonging to This Role 

    public function users(){

        return $this->belongsToMany('App\User','role_user')
        ->withTimestamps();
    }

}
