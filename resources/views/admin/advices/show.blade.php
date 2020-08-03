<?php 
    $array = explode('/', $advice->src);
    $file_name = $array[2];
?>
@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة النصائح</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        
      </div>
      <div class="col-lg-6">
        <a href="{{route('advice.index')}}" class="btn btn-primary button-margin-header custom-but pull-left" >ادارة النصائح  
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div> 
    </div>
  </div>

  <div id="table" class="row">
    <div class="col-lg-6">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>ملف النصيحة </small>
            </h2>
          </div>
           @if (  $advice->type == "video")
             {{--<video width="320" height="240" controls>--}}
            {{--<source src= {!! $advice->src !!} type="video/mp4">--}}
           {{--<source src= {!! $advice->src !!}  type="video/ogg">--}}
            {{--Your browser does not support the video tag.--}}
            {{--</video>--}}
           
             <iframe  width="320" height="240" src="https://www.youtube.com/embed/{!! $src !!}"></iframe>
        @elseif( $advice->type = "audio")
    
           <audio controls>
                     <source src= {!! $advice->src !!} type="audio/ogg">
                     <source src= {!! $advice->src !!} type="audio/mpeg">
                        Your browser does not support the audio element.
           </audio>
       
          @endif
         

        </div>
      </div>
    </div>
  </div>
        
  <div id="table" class="row">
    <div class="col-lg-8">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
              <h2>
                <small>
                  <i class="fa fa-file-archive-o" aria-hidden="true" style="font-size:24px;"></i>
                  <span style="direction:ltr; display: table-cell;"> {{$advice->title}}</span>
                </small>
              </h2>
            </div>
          <div  class="border-padding">
              <h3>الدروس التي تتبع لها :</h3>
            <table class="show-table">
                <th>  اسم الصف </th>
              <tbody>
              @foreach($adviceClasses as $class)
                  <tr>
                      <td style="direction:ltr;">{{$class->name}}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>


            <div  class="border-padding">
                <h3>الدورات التي تتبع لها :</h3>
                <table class="show-table">
                    <th>اسم الدورة</th>
                    <tbody>
                    @foreach($adviceCourses as $course)
                        <tr>
                            <td style="direction:ltr;">{{$course->title}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
          
          <form action="{{ route('advice.destroy',['advice' => $advice]) }}" method="POST" id="deleteForm">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="DELETE">    
                      <button class=" btn btn-danger custom-but">حذف الملف</button>     
          </form>       
                  
        </div>
      </div>
    </div>
  </div>

</div>

@endsection



