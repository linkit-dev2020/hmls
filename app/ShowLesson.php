<?php



namespace App;



use Illuminate\Database\Eloquent\Model;

use Storage;

use File;

use Cohensive\Embed\Facades\Embed;
//use Embed\Embed;


class ShowLesson extends Model

{

    protected $fillable = [

        'title',

        'order',

        'src']; 



        

    

        public function setSrcAttribute($value){



            $this->attributes['src'] = $value;

            

    

        }

    

        public function getUrl1Attribute()

        {

            return $this->attributes['src'] ;

        }

    

        public function getStoragePath($url){

    

            $segments = explode('/',$url);

    

            array_shift($segments);

    

            return implode('/',$segments);

        }



        public function getSrcAttribute($value){


            $embed = Embed::make($value)->parseUrl();

            if (!$embed)

            return '';

            else {

            $embed->setAttribute(['width' => 340]);

            return $embed->getHtml();

            } 

        }



}

