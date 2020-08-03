<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //guarded Attributes 

    protected $guarded = ['id','created_at','updated_at'];


    /**
     * The Comment owner of this reply 
     */
    public function comment(){

        return $this->belongsTo('App\Comment');
    }

    /**
     * The Model Replier owner of this Reply 
     * Polymorphic One To Many Relationship 
     */
    public function replier(){

        return $this->morphTo('replier','replier_type','replier_id');
    }

}
