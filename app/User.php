<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tc','full_name','username','phone','active','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    //Roles Belonging to This User 
    public function roles(){

        return $this->belongsToMany('App\Role','role_user')
            ->withTimestamps();
    }

    //any role check for the user
    public function hasAnyRole($roles)
    {
        if (is_array($roles))
         foreach($roles as $role )
         {
             if ($this->hasRole($role)){
                 return true;
             }
         
             
         }
         else return false;
    }
    //check if the user has a specific role
    public function hasRole($role)
    {
        if($this->roles()->where('role',$role)->first()){
        return true;
        }
        
        return false;
    }


    /**Comments posted by this teacher */
    public function comments(){

        return $this->hasMany('App\Comment','commenter','commenter_type','commenter_id');
    }

    /**Replier Posted By This Teacher */
    public function replies(){

        return $this->hasMany('App\Reply','replier','replier_type','replier_id');
    }

    /**Classes beloning to this this Teacher */
    public function classes(){

        return $this->belongsToMany('App\ClassRoom','class_teacher','teacher_id','class_id')
            ->withTimestamps();
    }
    public function classess(){

        return $this->belongsToMany('App\ClassRoom','class_student','student_id','class_id')
            ->withTimestamps();
    }

    /**
     * Subjects Belonging to this Teacher
     */
    public function subjects(){

        return $this->belongsToMany('App\Subject','subject_teacher','teacher_id','subject_id')
            ->withTimestamps();
    }

    /**
     * Courses Belonging to this Teacher 
     */
    public function courses(){

        return $this->belongsToMany('App\Course','course_teacher','teacher_id','course_id')
            ->withTimestamps();
    }

    public function coursess(){

        return $this->belongsToMany('App\Course','course_student','student_id','course_id')
            ->withTimestamps();
    }

    /**
     * Lessons which this teacher is teaching
     */
    public function lessons(){

        return $this->belongsToMany('App\Lesson','lesson_teacher','teacher_id','lesson_id')
            ->withTimestamps();
    }


    public function freeReasons(){


        return $this->belongsToMany('App\FreeReason','freereason_student','student_id','freereason_id')
        ->withTimestamps();
    }

    /**Evaluations By This student */
    public function evaluations(){


        return $this->hasMany('App\Evaluation');
    }

}
