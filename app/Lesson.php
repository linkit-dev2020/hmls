<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
use File;
use Cohensive\Embed\Facades\Embed;

class Lesson extends Model
{


    // Types Constants
    const VIDEO = 'video';
    const IMAGE = 'image';
    const PDF = 'pdf';
    const LINK = 'link';
    const WORD = 'word';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];


    //Operations On Courses
    public function makeActive(){

      $this->active = true ;
  }

  //Deactivate A Course
  public function makeInactive(){

      $this->active = false ;

  }
   public function getUrl1Attribute()
        {
            return $this->attributes['src'] ;
        }

  public function setSrcAttribute($value){
    if(($this->attributes['type'] === 'video') || ($this->attributes['type'] === 'url')) {
      $this->attributes['src'] = $value;
    }
    else
      $this->attributes['src'] = $this->getStoragePath($value);

}


public function getStoragePath($url){

    $segments = explode('/',$url);

    array_shift($segments);

    return implode('/',$segments);
}

public function getSrcAttribute($value){

  if($this->attributes['type'] === 'video') {
    if(!strpos($value,'youtube')&&!strpos($value,'you'))
    {
    //    return "<iframe src='$value' width='400' height='400' ></iframe>";
    }
    $embed = Embed::make($value)->parseUrl();
    if (!$embed)
    return '';
    else {
      $embed->setAttribute(['width' => 400]);
      return $embed->getHtml();
    }
  }
  elseif($this->attributes['type'] === 'url') {
    return $value;
  }
  else {
    return Storage::url($value) ;
  }

}

    /**
     * The Units that the lesson belongs to
     */
    public function units(){

        return $this->belongsToMany('App\Unit','lesson_unit')

        ->withTimestamps();

    }

    /**
     * Owner Subjects of this lesson
     */

     public function subjects(){

        return $this->belongsToMany('App\Subject','lesson_subject')
        ->withTimestamps();
     }

     /**
      * Classes owners of this lesson
      */
      public function classes(){


        return $this->belongsToMany('App\ClassRoom','class_lesson','lesson_id','class_id')
        ->withTimestamps();
      }


      /**
       * Courses owners of this lesson
       */
      public function courses(){

        return $this->belongsToMany('App\Course','course_lesson')
                ->withTimestamps();
      }

      /**
       * Attachments Belonging to this Lesson
       */
      public function attachments(){

          return $this->morphMany('App\Attachment','attachmentable');
      }


      /**
       * Comments Belonging to this lesson
       */
      public function comments(){

        return $this->hasMany('App\Comment');
      }

      /**
       * Evaluations For This Lesson
       */
      public function evaluations(){

        return $this->hasMany('App\Evaluation');
      }

      /**
       * Teachers for this Lesson
       */
      public function teachers(){

        return $this->belongsToMany('App\User','lesson_teacher','lesson_id','teacher_id')
          ->withTimestamps();
      }
}
