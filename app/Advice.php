<?php

namespace App;
use Storage;

use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    /**constants */
    const VIDEO = 'video'; 
    const AUDIO = 'audio';

    //Guarded Attributes
    protected $guarded = ['id','created_at','updated_at'];




    //Operations On Courses 
    public function makeActive(){

        $this->active = true ; 
        
        
    }
  
    //Deactivate A Course 
    public function makeInactive(){
  
        $this->active = false ; 
       
    }
    
    /**
     * Fetch the courses owner of this advice
     */
     
    public function courses(){


        return $this->belongsToMany('App\Course','advice_course','advice_id','course_id')->withTimestamps();
        
          
     
        }

    /**
     * Fetch the Classes owner of this advice
     */
      public function classes(){


            return $this->belongsToMany('App\ClassRoom','advice_class','advice_id','class_id')->withTimestamps();
    }

    public function setSrcAttribute($value){

        $this->attributes['src'] = $this->getStoragePath($value);


    }


    public function getStoragePath($url){

        $segments = explode('/',$url);

        array_shift($segments);

        return implode('/',$segments);
    }

    public function getSrcAttribute($value){

        return Storage::url($value) ; 
    }
}
