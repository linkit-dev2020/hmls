@extends('admin.layouts.master')

@section('content')
<style>
    .tab-content{
        display: none;
    }
</style>
    <?php
/**
 * Created by PhpStorm.
 * User: Inspiron
 * Date: 7/14/2019
 * Time: 1:55 AM
 */

?>

<style>
    .text-notes {
        height: 50px;
        background: #d6cab8;
        overflow: hidden;
        position: relative;
    }
    .text-notes p {
        position: absolute;
        color: #333;
        width: 100%;
        height: 100%;
        margin: 0;
        line-height: 50px;
        text-align: center;
        /* Starting position */
        -moz-transform:translateX(-100%);
        -webkit-transform:translateX(-100%);
        transform:translateX(-100%);
        /* Apply animation to this element */
        -moz-animation: text-notes 25 linear infinite;
        -webkit-animation: text-notes 25 linear infinite;
        animation: text-notes 25s linear infinite;
    }
    /* Move it (define the animation) */
    @-moz-keyframes text-notes {
        0%   { -moz-transform: translateX(-100%); }
        100% { -moz-transform: translateX(100%); }
    }
    @-webkit-keyframes text-notes {
        0%   { -webkit-transform: translateX(-100%); }
        100% { -webkit-transform: translateX(100%); }
    }
    @keyframes text-notes {
        0%   {
            -moz-transform: translateX(-100%); /* Firefox bug fix */
            -webkit-transform: translateX(-100%); /* Firefox bug fix */
            transform: translateX(-100%);
        }
        100% {
            -moz-transform: translateX(100%); /* Firefox bug fix */
            -webkit-transform: translateX(100%); /* Firefox bug fix */
            transform: translateX(100%);
        }
    }
</style>
@if($notes->count()>0)
    <div class="text-notes">
        @foreach($notes as $note)
            <p><?php echo $note->content.' ' ?></p>
        @endforeach
    </div>
@endif;
    <div class="container">
        <ul class="nav nav-tabs " style="margin-right: 15em;
    display: flex;
    align-items: center;">
            <li class="active"><a data-toggle="tab" href="#subjects">المواد الدراسية</a></li>
            <li><a data-toggle="tab" href="#denemy">الدينمي</a></li>
            {{--<li><a data-toggle="tab" href="#tests">الاختبارات</a></li>--}}
            <li><a data-toggle="tab" href="#advices">النصائح</a></li>
        </ul>

        <div class="tab-content">
        <div id="subjects" class="tab-pane fade in active">

            <div id="table" class="row">
                <div class="col-lg-12">
                    <div class="card table-cards color-grey">
                        <div class="card-body">
                            <div class="content-header">
                                <h2>
                                    <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> المواد الدراسية</small>
                                </h2>
                            </div>
                            <table class="table table-bordered table-hover table-width">
                                <thead>
                                <tr>
                                    <th>اسم المادة</th>
                                    @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                                        <th>التفعيل</th>
                                    @endif
                                    <th>الصف</th>
                                    <th>عدد الوحدات الدراسية</th>
                                    @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                                    <th>قابلية التنزيل</th>
                                    @endif
                                    <th>عرض</th>
                                    @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                                        <th>تعديل</th>
                                        <th>حذف</th>
                                        <th> تاريخ الاضافة</th>
                                        <th>  تاريخ التعديل</th>
                                    @endif

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subjects as $subject)
                                    <tr>
                                        <td>{{$subject->name}}</td>
                                        @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                                            <td class="operations">
                                                @if($subject->active)
                                                    <form action="{{ route('subject.deactivate', $subject) }}" method="POST" id="activateForm">
                                                        {!! csrf_field() !!}
                                                        <button id="{{$subject->id+1}}" class=" btn-xs delete-button" style="display:none;"></button>
                                                        <a herf="javascript:;" class="" onclick="$('#{{$subject->id+1}}').click();" >
                                                            <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                                                        </a>
                                                    </form>
                                                @else
                                                    <form action="{{ route('subject.activate', $subject) }}" method="POST" id="activateForm">
                                                        {!! csrf_field() !!}
                                                        <button id="{{$subject->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                                        <a herf="javascript:;" class="" onclick="$('#{{$subject->id}}').click();" >
                                                            <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                                                        </a>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                        <td>{{$subject->class->name}}</td>
                                        <td>{{$subject->units->count()}}</td>
                                        @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                                        @if($subject->downloable)
                                            <td>قابلة</td>
                                        @elseif(!$subject->downloable)
                                            <td>غير قابلة</td>
                                        @endif
                                        @endif
                                        <td>
                                            <div class="operations show">
                                                <a href="{{ route('subject.show', $subject) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                                            </div>
                                        </td>
                                        @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                                            <td>
                                                <div class="operations update">
                                                    <a href="{{ route('subject.edit', $subject) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                                                </div>
                                            </td>



                                            <td>
                                                <div class="operations delete">
                                                    <form action="{{ route('subject.destroy',['carousel' => $subject->id]) }}" method="POST" id="deleteForm">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button class="fa fa-trash"  style="border:none; font-size:18px;color:#dd4b39;cursor: pointer;" > </button>

                                                    </form>
                                                </div>
                                            </td>
                                            <td>{{$subject->created_at}}</td>
                                            <td>{{$subject->updated_at}}</td>
                                        @endif

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="denemy" class="tab-pane fade in">
            <div id="table" class="row">
                <div class="col-lg-12">
                    <div class="card table-cards color-grey">
                        <div class="card-body">
                            <div class="content-header">
                                <h2>
                                    <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدينيمي</small>
                                </h2>
                            </div>
                            <table class="table table-bordered table-hover table-width">
                                <thead>
                                <tr>
                                    <th>العنوان</th>
                                    @if(Auth::user()->hasAnyRole([0,1,2]))
                                    <th>الفعالية</th>
                                    @endif
                                    <th>الفصل</th>
                                    <th>النوع</th>
                                    <th>عرض</th>
                                    @if(Auth::user()->hasAnyRole([0,1,2]))
                                    <th>تعديل</th>
                                    <th>حذف</th>
                                        @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($denemes as $deneme)
                                    <tr>
                                        <td>{{$deneme->title}}</td>
                                        @if(Auth::user()->hasAnyRole([0,1,2]))
                                        @if($deneme->active)
                                            <td class="operations">
                                                <form action="{{ route('deneme.deactivate', $deneme) }}" method="POST" id="activateForm">
                                                    {!! csrf_field() !!}
                                                    <button id="{{$deneme->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                                    <a herf="javascript:;" class="" onclick="$('#{{$deneme->id}}').click();" >
                                                        <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        @elseif(!$deneme->active)
                                            <td class="opreations">
                                                <form action="{{ route('deneme.activate', $deneme) }}" method="POST" id="activateForm">
                                                    {!! csrf_field() !!}
                                                    <button id="{{$deneme->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                                    <a herf="javascript:;" class="" onclick="$('#{{$deneme->id}}').click();" >
                                                        <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        @endif
                                        @endif
                                        <td>{{$deneme->term}}</td>
                                        <td>{{$deneme->type}}</td>
                                        <td>
                                            <div class="operations show">
                                                <a href="{{ route('deneme.show', $deneme) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                                            </div>
                                        </td>
                                        @if(Auth::user()->hasAnyRole([0,1,2]))
                                        <td>
                                            <div class="operations update">
                                                <a href="{{ route('deneme.edit', $deneme) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="operations delete">
                                                <form action="{{ route('deneme.destroy',['carousel' => $deneme->id]) }}" method="POST" id="deleteForm">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="fa fa-trash"  style="border:none; font-size:18px;color:#dd4b39;cursor: pointer;" > </button>

                                                </form>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--<div id="tests" class="tab-pane fade in">--}}
            {{--<p>tests</p>--}}
        {{--</div>--}}
        <div id="advices" class="tab-pane fade in">

            @if($class->advices->count()> 0 )
                <div id="table3" class="row">
                    <table class="col-lg-8 col-lg-pull-2 table table-bordered table-hover table-width">
                        <thead>
                        <tr>
                            <th>اسم النصيحة</th>
                            <th>الملف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  foreach ($class->advices as $classAdvice): ?>
                        <tr>
                            <td>{{$classAdvice->title}}</td>
                            <td>

                                @if (  $classAdvice->type == "video")
                                    {{--<video width="320" height="240" controls>--}}
                                    {{--<source src= {!! $advice->src !!} type="video/mp4">--}}
                                    {{--<source src= {!! $advice->src !!}  type="video/ogg">--}}
                                    {{--Your browser does not support the video tag.--}}
                                    {{--</video>--}}
                                    <?php

                                    $src = '' ;
                                    if(strpos($classAdvice->src, 'youtu.be')){
                                        $src=str_replace("/storage//youtu.be/","",$classAdvice->src);
                                    }


                                    ?>

                                    <iframe  width="320" height="240" src="https://www.youtube.com/embed/<?php echo $src;?>"></iframe>
                                @elseif( $classAdvice->type == "audio")

                                    <audio controls>
                                        <source src= {!! $classAdvice->src !!} type="audio/ogg">
                                        <source src= {!! $classAdvice->src !!} type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>

                                @endif
                            </td>


                        </tr>
                        <?php  endforeach;  ?>
                        </tbody>
                    </table>
                </div>
            @endif


        </div>
         <div>

    </div>




@endsection