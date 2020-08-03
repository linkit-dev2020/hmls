<?php



namespace App;



use Illuminate\Database\Eloquent\Model;

use Storage;
use Cohensive\Embed\Facades\Embed;




class Attachment extends Model

{

    



    //constants 

    const IMAGE = 'image';

    const PDF = 'pdf';

    const WORD = 'word';





    //guarded Attributes 

    protected $guarded = ['id','created_at','updated_at'];





    //Relationship to Test ot Deneme or Lesson



    /**

     * Attachmentable Models Owener of this Attachment

     */

    public function attachmentable(){



        return $this->morphTo();

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
            //return $this->attributes['src'];
            $embed = Embed::make($this->attributes['src'])->parseUrl();
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




}

