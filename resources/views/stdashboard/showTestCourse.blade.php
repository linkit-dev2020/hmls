@extends('stdashboard.master3')
@section('content')
    @if($test->type=="image")
        <img src="{{asset($test->src)}}" width="100%">
    @elseif($test->type=="video")
        <?php

        $src = '' ;
        $newSrc= substr($test->src,strpos($test->src,'?v=')+3);
       // echo $newSrc;
        if(strpos($test->src, 'youtu.be')){
            $src=str_replace("/storage//youtu.be/","",$test->src);
        }



        ?>
        {!! $test->src !!}
    @elseif($test->type=="pdf")
        <a class="btn btn-primary" href="{{asset($test->src)}}" >تحميل</a>
    @elseif($test->type=="word")
        <a class="btn btn-primary" href="{{asset($test->src)}}" >تحميل</a>
    @elseif($test->type="url")
        <a class="btn btn-primary" href="{{asset($test->src)}}" >فتح الرابط</a>
    @elseif($test->type=="audio")
        <a class="btn btn-primary" href="{{asset($test->src)}}" >فتح الصوت</a>
    @endif


    <br><br>
    <h3 id="att_h" style="text-align: right!important;">مرفقات الاختبار</h3>


@endsection

