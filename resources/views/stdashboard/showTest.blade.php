@extends('stdashboard.master2')
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

    <ul class="list-group">
        @foreach($test->attachments as $att)
            <script>
                document.getElementById("att_h").style.display='block';
            </script>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{asset($att->src)}}" >{{$att->name}}</a>
                @if($att->type=='pdf')
                    <span class="badge badge-primary badge-pill"><i class="fa fa-file-pdf-o"></i></span>
                @elseif($att->type=='word')
                    <span class="badge badge-primary badge-pill"><i class="fa fa-file-word-o"></i></span>
                @elseif($att->type=='url')
                    <span class="badge badge-primary badge-pill"><i class="fa fa-globe"></i></span>
                @elseif($att->type=='video')
                    <span class="badge badge-primary badge-pill"><i class="fa fa-file-video-o"></i></span>
                @elseif($att->type=='image')
                    <span class="badge badge-primary badge-pill"><i class="fa fa-file-image-o"></i></span>
                @endif
            </li>
        @endforeach
    </ul>
@endsection

