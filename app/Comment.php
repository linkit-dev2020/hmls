<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //guarded attributes 
    protected $guarded = ['id','created_at','updated_at'];


    //Lesson Owner of this comment 
    public function lesson(){

        return $this->belongsTo('App\Lesson');
    }

    //Replies belonging to this Comment 

    public function replies(){
        return $this->hasMany('App\Reply');
    }		public function childs(){		return $this->hasMany( 'App\Comment', 'parent', 'id' );	}

    //Commenter 
    //return App\Teacher Eloquent Model 
    //Or App\Student Eloquent Mode l
    //Or App\Manager Eloquent Model 

    public function commenter(){

        return $this->belongsTo('App\User');
    }
}
