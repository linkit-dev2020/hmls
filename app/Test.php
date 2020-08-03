<?php



namespace App;



use Illuminate\Database\Eloquent\Model;

use Storage;

use Cohensive\Embed\Facades\Embed;


class Test extends Model

{

    //constants

    const FIRST_TERM = 1 ;

    const SECOND_TERM = 2 ;

    const SUBTEST_1 = 1 ;

    const SUBTEST_2 = 2 ;





    //guarded attribute

    protected $guarded = [

        'id',

        'created_at',

        'updated_at'

    ];





    //get the name of file from the full path

    public function setSrcAttribute($value){

        if($this->attributes['type']=='video')
            $this->attributes['src']=$value;
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
            $embed = Embed::make($this->attributes['src'])->parseUrl();
            //return $this->attributes['src'];
            $embed->setAttribute(['width' => 400]);
            return $embed->getHtml();
        }
        elseif($this->attributes['type'] === 'url') {
            return $value;
        }
        else {
            return Storage::url($value) ;
        }

    }




    //Subjects belonging to this Test

    public function subjects(){



        return $this->belongsToMany('App\Subject','subject_test');

    }



    //Attachments belonging to this Test

    public function attachments(){

        return $this->morphMany('App\Attachment','attachmentable');

    }



    /**Model Operations */



    //activate A Test

    public function activate(){



        $this->active = true ;

    }



    //deactivate A Test

    public function deactivate(){



        $this->active = false ;

    }



}

