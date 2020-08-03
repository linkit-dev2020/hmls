@extends('admin.layouts.master')

@section('content')

<?php 
    $subjects= $class->subjects;
?>
<style>
  .nav-tabs > li {
     float: none;
    margin-bottom: -1px;
  }
</style>
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
<div id="content">
  @if(Auth::user()->hasAnyRole([0,1]))
    <div class="header-card table-cards color-grey">
      <div class="row">
        <div class="col-lg-4">
          <div class="content-header">
            <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة {{$class->name}}</small></h1>
          </div>
        </div>
        <div class="col-lg-2">

        </div>
        <div class="col-lg-6">
          <a href="{{route('class.index')}}" class="btn btn-primary button-margin-header custom-but pull-left" > إدارة كافة الصفوف
            <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
          </a>
        </div>
      </div>
    </div>
  @elseif(Auth::user()->hasAnyRole([2,3]))
    <div class="header-card table-cards color-grey">
      <div class="row">
        <div class="col-lg-4">
          <div class="content-header">
            <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> محتوى {{$class->name}}</small></h1>
          </div>
        </div>

        <div class="col-lg-2">
          <form action="{{ route('classrequest.store') }}" method="POST" id="makeClassFreeForm" style="display:inline; margin-right:10px;">
            {!! csrf_field() !!}
            <input type="hidden" name="class_id" value="{{$class->id}}">
            <a href="#" class="btn btn-success button-margin-header custom-but"
               onclick="document.getElementById('makeClassFreeForm').submit();"> طلب انضمام لهذا الصف</a>
          </form>
        </div>
        <div class="col-lg-6">
          <a href="{{route('class.index')}}" class="btn btn-primary button-margin-header custom-but pull-left" > العودة
            <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
          </a>
        </div>
      </div>
    </div>
  @endif



    @if(($class->free && Auth::user()->hasRole(3)) || (!Auth::user()->hasRole(3)) )

      <div class="container">
        <ul class="nav nav-tabs " style="margin-right: 15em;
    display: flex;
    align-items: center;">
          <li class="active"><a data-toggle="tab" href="#home">المواد الدراسية</a></li>
         <!-- <li><a data-toggle="tab" onclick="pauseAllAudio()" href="#menu1">المدرسون</a></li> -->
          <li><a data-toggle="tab" onclick="" href="#menu2">النصائح</a></li>
		  <li><a data-toggle="tab" onclick="pauseAllAudio()" href="#menu3">الدينمي</a></li>
		  <li><a data-toggle="tab" onclick="pauseAllAudio()" href="#menu4">طلاب الصف</a></li>
		  
        </ul>
		<script>
			function pauseAllAudio()
			{
				var sounds = document.getElementsByTagName('audio');
				for(i=0; i<sounds.length; i++) sounds[i].pause();
				var ifrms=document.getElementsByTagName('iframe');
				for(i=0;i<ifrms.length;i++)
				{
					var src=ifrms[i].src;
					ifrms[i].src="";
					ifrms[i].src=src;
					
				}
			}
		</script>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
            <div id="table" class="row">
              <div class="col-lg-12 col-md-12  col-m-u">
                <div class="card table-cards color-grey">
                  <div class="card-body">
                    <div class="content-header">
                      <div class="col-lg-8 ">
                        <h2>
                          <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> المواد الدراسية ضمن {{$class->name}}</small>
                        </h2>
                      </div>
                      @if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                        <div claass="col-lg-2">
                          <a href="/subjects/create?selectedclass={{$class->id}}" class="btn btn-success button-margin-header custom-but" style="margin-right: 22px" >إضافة مادة
                            <i class="fa fa-plus" aria-hidden="true" style="font-size:16px"></i>
                          </a>
                        </div>
                      @endif
                    </div>
                    <table class="table table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th>اسم المادة</th>
                        @if(Auth::user()->hasAnyRole([0,1]))
                          <th>التفعيل</th>
                        @endif
                        <th>عدد الوحدات الدرسية</th>
                        <th>قابلية الدروس للتنزيل</th>
                        <th>العرض</th>
                        @if(Auth::user()->hasAnyRole([0,1]))
                          <th>التعديل</th>
                          <th>الحذف</th>
                        @endif
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($class->subjects as $subject)
                        <tr>
                          <td>{{$subject->name}}</td>
                          @if(Auth::user()->hasAnyRole([0,1]))
                            @if($subject->active)
                              <td class="operations">
                                <form action="{{ route('subject.deactivate', $subject) }}" method="POST" id="activateForm">
                                  {!! csrf_field() !!}
                                  <button id="{{$subject->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                  <a herf="javascript:;" class="" onclick="$('#{{$subject->id}}').click();" >
                                    <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                                  </a>
                                </form>
                              </td>
                            @else
                              <td class="operations">
                                <form action="{{ route('subject.activate', $subject) }}" method="POST" id="activateForm">
                                  {!! csrf_field() !!}
                                  <button id="{{$subject->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                  <a herf="javascript:;" class="" onclick="$('#{{$subject->id}}').click();" >
                                    <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                                  </a>
                                </form>
                              </td>
                            @endif
                          @endif
                          <td>{{$subject->units->count()}}</td>
                          @if($subject->downloable)
                            <td>قابلة للتنزيل</td>
                          @else
                            <td>غير قابلة للتنزيل</td>
                          @endif
                          <td>
                            <div class="operations show">
                              <a href="{{ route('subject.show', $subject) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                            </div>
                          </td>
                          @if(Auth::user()->hasAnyRole([0,1]))
                            <td>
                              <div class="operations update">
                                <a href="{{ route('subject.edit', $subject) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                              </div>
                            </td>
                            <td>
                              <div class="operations delete">
                                <form action="{{ route('subject.destroy', $subject) }}" method="POST" id="deleteForm">
                                  {!! csrf_field() !!}
                                  <input type="hidden" name="_method" value="DELETE">
                                  <button id="del{{$subject->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                  <a herf="javascript:" class="" onclick="$('#del{{$subject->id}}').click();" >
                                    <i class="fa fa-trash" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
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

          </div>
          <div id="menu1" class="tab-pane fade">
            @if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) )
              <div id="table2" class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <div class="card table-cards color-grey">
                    <div class="card-body">
                      <div class="content-header">
                        <h2>
                          <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> إضافة مدرس لهذا الصف</small>
                        </h2>
                      </div>

                      <form action="{{route('class.addteacher',$class)}}" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group">
                          <label for="addteacher">اختر مدرس لاضافته الى هذا الصف :</label>
                          <select class="form-control form-control-select mt-3" id="addteacher" name="teacher">
                            <option selected>-- اختر مدّرس --</option>
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

            <div id="table" class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card table-cards color-grey">
                  <div class="card-body">
                    <div class="content-header">
                      <h2>
                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>مدرسوا الصف</small>
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
                      @foreach($teachersClass as $teacherClass)
                        <tr>
                          <td>{{$teacherClass->username}}</td>


                          @if(Auth::user()->hasAnyRole([0,1]))
                            <td>
                              <div class="operations delete">
                                <form action="{{ route('class.deleteteacher',['class' => $class->id, 'teacher_id'=>$teacherClass->id]) }}" method="POST" id="deleteForm">
                                  {!! csrf_field() !!}

                                  <button id="{{$class->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                  <a herf="javascript:;" class="" onclick="$('#{{$class->id}}').click();" >
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
          </div>
          <div id="menu2" class="tab-pane fade">

            @if($class->advices->count()> 0 )
              <div id="table3" class="row">
                <table class="col-lg-12 col-sm-12 col-md-12 table table-bordered table-hover table-width">
                  <thead>
                  <tr>
                    <th>اسم النصيحة</th>
                    <th>الملف</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  foreach ($classAdvices as $classAdvice): ?>
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
          <div id="menu3" class="tab-pane fade">
            <div id="table" class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
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
                        <th>الفعالية</th>
                        <th>الفصل</th>
                        <th>النوع</th>
                        <th>عرض</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($denemes as $deneme)

                        <tr>
                          <td>{{$deneme->title}}</td>
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
                          <td>{{$deneme->term}}</td>
                          <td>{{$deneme->type}}</td>
                          <td>
                            <div class="operations show">
                              <a href="{{ route('deneme.show', $deneme) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                            </div>
                          </td>
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
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  
		  
		  <div id="menu4" class="tab-pane fade">
            <div id="table" class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
                <div class="card table-cards color-grey">
                  <div class="card-body">
                    <div class="content-header">
                      <h2>
                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>طلاب الصف</small>
                      </h2>
					  <form action="{{ route('class.deleteAllStudents',['class' => $class->id]) }}" method="POST" id="deleteForm">
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
								<form action="{{ route('class.deletestudent',['class' => $class->id]) }}" method="POST" id="deleteForm">
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

    @endif





</div>






@endsection



