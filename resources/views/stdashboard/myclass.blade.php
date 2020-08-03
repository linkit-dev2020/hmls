@extends('stdashboard.master')
@section('title')
    @if(Auth::check())
        حسابي
    @else
        تركي هوم
    @endif
@endsection

@section('marq')
    @php
        $notes=\App\Note::where('type','public')->get();

    @endphp

    @foreach($notes as $note)
        {{$note->content}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    @endforeach
@endsection

@section('content')

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
                    <div class="language_title wow flipInX">دينيمي , {{$class->name}}</div>
                </div>
            </div>
        </div>
    </div>


    <div class="courses">
        <div class="container">
            <div class="row courses_row">
            @foreach($class->denemes as $sub)
                <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course wow fadeInRight">
                            <div class="course_image"><img src="" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a href="">{{$sub->name}}</a></div>
                            </div>
                            <div class="course_footer d-flex flex-row align-items-center justify-content-start">
                                <div class="course_rating ml-auto"><i class="fa fa-star" aria-hidden="true"></i><span>4,5</span></div>
                            </div>
                        </div>
                    </div>
                    <!-- Course -->
                @endforeach
            </div>
        </div>
    </div>



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

@endsection
