@extends('stdashboard.master')
@section('title')
    @if(Auth::check())
        حسابي
    @else
    HMLS
    @endif
@endsection

@section('marq')
    @php
        $notes=\App\Note::where('class_id',$class->id)->where('type','private')->get();

    @endphp

    @foreach($notes as $note)
        {{$note->content}}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    @endforeach

@endsection

@section('content')
    <style>
        .course_image{
            width: 100%!important;
            height: 250px!important;
            text-align: center!important;
            background-color: #fff!important;
        }
        .course_body{
            width: 100%!important;
            height: 100px!important;
        }
    </style>
    <div class="language ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if ( session('success') )

                        <div class = "alert alert-success">

                            {{session('success')}}

                        </div>

                    @endif

                    @if ( session('error') )

                        <div class = "alert alert-danger">

                            {{session('error')}}

                        </div>

                    @endif
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <div class="language_title wow flipInX">مواد , {{$class->name}}</div>
                </div>
            </div>
        </div>
    </div>


    <div class="courses">
        <div class="container">
            <div class="row courses_row">
            @foreach($class->subjects->sortBy('order_num') as $sub)
                <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course wow fadeInRight">
                            <div class="course_image"><img src="{{Storage::url($sub->cover)}}" alt=""></div>
                            <div class="course_body">
                                <?php
                                $cid=$class->id;
                                $sid=-1;
                                if(Auth::check())
                                    $sid=Auth::user()->id;
                                $match=['student_id'=>$sid,'class_id'=>$cid];
                                $a=\App\ClassStudent::where('student_id',$sid)->where('class_id',$cid)->first();
                                $new=true;
                                if($a!==null&&$a->count()>0)
                                {
                                    $new=false;

                                }

                                ?>
                                @if(Auth::check()&&Auth::user()->hasAnyRole([0,1]))
                                        <div class="course_title"><a href="/stdsh/show/{{$sub->id}}/">{{$sub->name}}</a></div>
                                @else
                                        @if($new||!$sub->active)
                                            <div class="course_title"><a>{{$sub->name}}</a></div>
                                        @else
                                            <div class="course_title"><a href="/stdsh/show/{{$sub->id}}/">{{$sub->name}}</a></div>
                                        @endif
                                @endif
                            </div>

                            <div class="course_footer d-flex flex-row align-items-center justify-content-start">
                                <div class="course_rating ml-auto"><i class="fa @if($sub->active) fa-check-circle @else fa-times-circle @endif" aria-hidden="true"></i>
                                    <span>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Course -->
                @endforeach
            </div>
        </div>
    </div>







        <br><br><br><br>
        <br><br><br><br>
@endsection
