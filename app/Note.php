<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //constants 

    const PUBLIC = 'public';
    const PRIVATE = 'private';


    //guarded attributes 
    protected $guarded = ['id','created_at','updated_at'];


    //Class owner of this Note 
    public function class(){

        return $this->belongsTo('App\ClassRoom','class_id');
    }
}
