<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



use Storage;

use Cohensive\Embed\Facades\Embed;



class Deneme extends Model

{

    



    //constants 

    const VIDEO = 'video';

    const IMAGE = 'image';

    const PDF = 'pdf';

    const WORD = 'word';

    const LINK = 'link';



    //guarded attributes 

    protected $guarded = ['id','created_at','updated_at'];





    /**

     * Class Owner of this Deneme

     */

    public function class(){



        return $this->belongsTo('App\ClassRoom','class_id');

    }



    /**

     * Attachments belonging to this Denme

     */

    public function attachments(){



        return $this->morphMany('App\Attachment','attachmentable');

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

        $embed = Embed::make($value)->parseUrl();

        if (!$embed)

        return '';

        else {

          $embed->setAttribute(['width' => '100%','height'=>250,'id'=>'denplayer']);

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

 

}

