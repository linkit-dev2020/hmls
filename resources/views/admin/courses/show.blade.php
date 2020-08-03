@extends('admin.layouts.master')

@section('content')
    <div id="content" class="container">
        @if(Auth::user()->hasAnyRole([0,1,2]))
            <div class="header-card table-cards color-grey">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="content-header">
                            <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدورات الدراسية</small></h1>
                        </div>
                    </div>
                    @if(Auth::user()->hasAnyRole([0,1]))
                        <div class="col-lg-2">
                            @if(!$course->active)
                                <form action="{{ route('course.activate', $course) }}" method="POST" id="makeCourseActive" style="display:inline; margin-right:10px;">
                                    {!! csrf_field() !!}
                                    <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makeCourseActive').submit();">تفعيل الدورة</a>
                                </form>
                            @else
                                <form action="{{ route('course.deactivate', $course) }}" method="POST" id="makeCourseDeactive" style="display:inline; margin-right:10px;">
                                    {!! csrf_field() !!}
                                    <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makeCourseDeactive').submit();">إلغاء تفعيل الدورة</a>
                                </form>
                            @endif
                        </div>
                    @endif
                    <div class="col-lg-2">
                        <a href="/lessons/create?selectedcourse={{$course->id}}" class="btn btn-success button-margin-header" style="margin-right: 22px" >إضافة درس
                            <i class="fa fa-plus" aria-hidden="true" style="font-size:16px"></i>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="{{route('course.index')}}" class="btn btn-primary button-margin-header custom-but pull-left" > إدارة كافة الدورات
                            <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->hasAnyRole([3]))
            <div class="header-card table-cards color-grey">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content-header">
                            <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> محتوى {{$course->title}}</small></h1>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ URL::previous() }}" class="btn btn-primary button-margin-header custom-but pull-left" > العودة
                            <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    <ul class="nav nav-tabs " style="margin-right: 15em;
    display: flex;
    align-items: center;">
        <li class="active"><a data-toggle="tab" href="#home">الدروس</a></li>
        <li><a data-toggle="tab" href="#menu1">المدرسون</a></li>
        <li><a data-toggle="tab" href="#menu2">النصائح</a></li>
        @if(Auth::user()->hasAnyRole([0,1]))
        <li><a data-toggle="tab" href="#menu3">طلاب الدورة</a></li>
        @endif
    </ul>
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">

            @if(Auth::user()->hasAnyRole([0,1,2]))
                <div id="table" class="row">
                    <div class="card-deck">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card color-grey">
                                <div class="card-body">
                                    <div class="card-header">اضافة درس للدورة</div>

                                    <form action="{{route('course.addlesson', ['course' => $course])}}"
                                          enctype="multipart/form-data" method="GET">
                                        {!! csrf_field() !!}

                                        <div class="form-group">
                                            <label for="lesson">اختر الدرس :</label>
                                            <select class="form-control form-control-select mt-3" id="lesson" name="lesson">
                                                <option selected>-- اختر درس --</option>

                                                @foreach($Alllessons as $lesson)


                                                    <option value="{{$lesson->id}}">{{$lesson->title}}</option>


                                                @endforeach

                                            </select>

                                        </div>

                                        <button type="submit" class="btn btn-success myhover">إضافة</button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif ;


                <div id="table" class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
                        <div class="card table-cards color-grey">
                            <div class="card-body">
                                <div class="content-header">
                                    <h2>
                                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدروس المعتمدة ضمن {{$course->title}}</small>
                                    </h2>
                                </div>
                                <table class="table table-bordered table-hover table-width">
                                    <thead>
                                    <tr>
                                        <th>عنوان الدرس</th>
                                        <th>نوع الملف</th>
                                        <th>العرض</th>
                                        @if(Auth::user()->hasAnyRole([0,1,2]))
                                            <th>التفعيل</th>
                                            <th>التعديل</th>
                                            <th>الحذف</th>

                                        @endif

                                        @if(Auth::user()->hasAnyRole([0,1]))
                                            <th>فصل عن الدورة</th>
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lessons as $lesson)
                                        @if($lesson->active === 0 && Auth::user()->hasRole(3))

                                        @else
                                            <tr>
                                                <td>{{$lesson->title}}</td>
                                                <td>{{$lesson->type}}</td>
                                                <td>
                                                    <div class="operations show">
                                                        <a href="{{ route('lesson.show', $lesson) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                                                    </div>
                                                </td>
                                                @if(Auth::user()->hasAnyRole([0,1,2]))
                                                    <td class="operations">
                                                        @if($lesson->active)
                                                            <form action="{{ route('lesson.deactivate', $lesson) }}" method="POST" id="activateForm">
                                                                {!! csrf_field() !!}
                                                                <button id="dect{{$lesson->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                                                <a herf="javascript:;" class="" onclick="$('#dect{{$lesson->id}}').click();" >
                                                                    <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                                                                </a>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('lesson.activate', $lesson) }}" method="POST" id="activateForm">
                                                                {!! csrf_field() !!}
                                                                <button id="active{{$lesson->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                                                <a herf="javascript:;" class="" onclick="$('#active{{$lesson->id}}').click();" >
                                                                    <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                                                                </a>
                                                            </form>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="operations update">
                                                            <a href="{{ route('lesson.edit', $lesson) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="operations delete">
                                                            <form action="{{ route('lesson.destroy', $lesson) }}" method="POST" id="deleteForm">
                                                                {!! csrf_field() !!}
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button id="delete{{$lesson->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                                                <a herf="javascript:;" class="" onclick="$('#delete{{$lesson->id}}').click();" >
                                                                    <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                                                </a>
                                                            </form>

                                                        </div>
                                                    </td>
                                                    @if(Auth::user()->hasAnyRole([0,1]))
                                                    <td>
                                                        <div class="operations delete">
                                                            <form action="{{ route('course.deletelesson',['course' => $course->id]) }}" method="POST" id="deleteForm">
                                                                {!! csrf_field() !!}
                                                                <input type="hidden" id="lesson_id" name="lesson_id" value="{{$lesson->id}}" />
                                                                <button id="deat{{$course->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                                                <a herf="javascript:;" class="" onclick="$('deat#{{$course->id}}').click();" >
                                                                    <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div id="menu1" class="tab-pane fade">

            <div id="table" class="row">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="card table-cards color-grey">
                        <div class="card-body">
                            <div class="content-header">
                                <h2>
                                    <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>مدرسوا الدورة</small>
                                </h2>
                            </div>
                            <table class="table table-bordered table-hover table-width">
                                <thead>
                                <tr>
                                    <th>اسم المدرس</th>
                                    @if(Auth::user()->hasAnyRole([0,1]))
                                        <th>حذف</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teachersCourse as $teacherCourse)
                                    <tr>
                                        <td>{{$teacherCourse->username}}</td>


                                        @if(Auth::user()->hasAnyRole([0,1]))
                                            <td>
                                                <div class="operations delete">
                                                    <form action="{{ route('course.deleteteacher',['course' => $course->id, 'teacher_id'=>$teacherCourse->id]) }}" method="POST" id="deleteForm">
                                                        {!! csrf_field() !!}

                                                        <button id="{{$course->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                                        <a herf="javascript:;" class="" onclick="$('#{{$course->id}}').click();" >
                                                            <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                                        </a>
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
            @if(Auth::user()->hasAnyRole([0,1]))
                <div id="table2" class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="card table-cards color-grey">
                            <div class="card-body">
                                <div class="content-header">
                                    <h2>
                                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> </small>
                                    </h2>
                                </div>

                                <form action="{{route('course.addteacher',$course)}}" method="POST">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="addteacher">اختر مدرس لاضافته الى هذه الدورة</label>
                                        <select name="teacher" id="teacher" class="form-contorl form-control-select mt-3">
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->username}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-success button1" value="اضافة المدرس">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <div id="menu2" class="tab-pane fade">
            @if($course->advices->count()> 0 )
                <div id="table3" class="row">
                    <table class="col-lg-12 col-md-12 col-sm-12 col-lg-pull-2 table table-bordered table-hover table-width">
                        <thead>
                        <tr>
                            <th>اسم النصيحة</th>
                            <th>الملف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  foreach ($courseAdvices as $courseAdvice): ?>
                        <tr>
                            <td>{{$courseAdvice->title}}</td>
                            <td>

                                @if (  $courseAdvice->type == "video")
                                    {{--<video width="320" height="240" controls>--}}
                                    {{--<source src= {!! $advice->src !!} type="video/mp4">--}}
                                    {{--<source src= {!! $advice->src !!}  type="video/ogg">--}}
                                    {{--Your browser does not support the video tag.--}}
                                    {{--</video>--}}
                                    <?php

                                    $src = '' ;
                                    if(strpos($courseAdvice->src, 'youtu.be')){
                                        $src=str_replace("/storage//youtu.be/","",$courseAdvice->src);
                                    }


                                    ?>

                                    <iframe  width="320" height="240" src="https://www.youtube.com/embed/<?php echo $src;?>"></iframe>
                                @elseif( $courseAdvice->type == "audio")

                                    <audio controls>
                                        <source src= {!! $courseAdvice->src !!} type="audio/ogg">
                                        <source src= {!! $courseAdvice->src !!} type="audio/mpeg">
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
        @if(Auth::user()->hasAnyRole([0,1]))
		<!-- new tab -->
			 <div id="menu3" class="tab-pane fade">
            <div id="table" class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
                <div class="card table-cards color-grey">
                  <div class="card-body">
                    <div class="content-header">
                      <h2>
                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>طلاب الدورة</small>
                      </h2>
					  <form action="{{ route('course.deleteAllStudents',['course' => $course->id]) }}" method="POST" id="deleteForm">
									{!! csrf_field() !!}
									<input type="submit" class="btn btn-danger"  value="فصل جميع الطلاب" />
					   </form>
                    </div>
                    <table class="table table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th>اسم الطالب</th>
                        <th>فصل</th>
                      </tr>
                      </thead>
                      <tbody>

                      @foreach($students as $st)
                        <tr>
                          <td>{{$st->full_name}}</td>
                          <td>
                            <div class="operations delete">
								<form action="{{ route('course.deletestudent',['course' => $course->id]) }}" method="POST" id="deleteForm">
									{!! csrf_field() !!}
									<input type="hidden" name="student_id" value="{{$st->id}}">
									<button class="fa fa-trash"  style="border:none; font-size:18px;color:#dd4b39;cursor: pointer;" > </button>
								</form>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
		<!-- end -->
      @endif
    </div>









</div>

@endsection


