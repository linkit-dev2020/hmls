<?php

namespace App;

use App\User  ; 
use Illuminate\Database\Eloquent\Model;

class Manager extends User
{
    

    //Listen to created event to attach it a Manager Role 

    
    protected $table = 'users'; 


    //Comments posted by this manager 
    public function comments(){

        return $this->morphMany('App\Comment','commenter','commenter_type','commenter_id');
    }

    //Replies Posted By this Manager 
    public function replies(){
        return $this->morphMany('App\Reply','replier','replier_type','replier_id');
    }
}
