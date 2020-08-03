<?php
/**
 * Created by PhpStorm.
 * User: Inspiron
 * Date: 7/15/2019
 * Time: 9:05 PM
 */

namespace App\utils ;
 class Utils
 {
     public  static  function  getSrcFromVideo($src){

         $src = '' ;
         if(strpos($src, 'youtu.be')){
             $src=str_replace("/storage//youtu.be/","",$src);
         }

         return $src ;
     }

 }


?>


