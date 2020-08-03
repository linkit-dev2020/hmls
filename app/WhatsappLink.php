<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhatsappLink extends Model
{
    //Constants 
    const HOMEWORK = 'homework';
    const LESSON = 'lesson';

    //guarded Attributes 
    protected $guarded = ['id','created_at','updated_at'];


    //Polymorphic Relationship to Course or Class

    public function linkable(){

        return $this->morphTo('linkable','linkable_type','linkable_id');
    }

    /**
     * Fetch All Students which have click this link
     */
    public function students(){

        return $this->belongsToMany('App\Student','whatsapplink_student','whatsapp_link','student_id')
        ->withTimestamps();
    }
}
