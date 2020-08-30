@extends('admin.layouts.master')

@section('content')

<div id="content">
  @if(Auth::user()->hasAnyRole([0,1]))

    <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="content-header" style="background-image: url({{Storage::url($subject->cover)}});background-size: cover;width: 100%;height: 500px">
         <center><img src="" style="width:100%;max-width:600px;" /></center>
        </div>
      </div>
	</div>
	</div>
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-5">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة مادة {{$subject->name}} ل {{$subject->class->name}}</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        @if(!$subject->active)
        <form action="{{ route('subject.activate', $subject) }}" method="POST" id="makeSubjectActivate" style="display:inline; margin-right:10px;">
          {!! csrf_field() !!}
          <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makeSubjectActivate').submit();"> اجعل المادة مفعلة </a>
          </form>
          @else
          <form action="{{ route('subject.deactivate', $subject) }}" method="POST" id="makeSubjectDeactivate" style="display:inline; margin-right:10px;">
            {!! csrf_field() !!}
            <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makeSubjectDeactivate').submit();"> اجعل المادة غير مفعلة</a>
        </form>
        @endif
      </div>
      <div class="col-lg-2">
        <!-- <a href="/classes/{{$subject->class->id}}/units/create?selectedsubject={{$subject->id}}" class="btn btn-success button-margin-header custom-but" style="margin-right: 22px" >إضافة وحدة
         -->
         <a href="/units/create?selectedsubject={{$subject->id}}" class="btn btn-success button-margin-header custom-but" style="margin-right: 22px" >إضافة وحدة

         <i class="fa fa-plus" aria-hidden="true" style="font-size:16px"></i>
        </a>
      </div>
      <div class="col-lg-3">
        <a href="{{route('subject.index')}}" class="btn btn-primary button-margin-header custom-but pull-left" > إدارة كافة المواد
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div>
    </div>
  </div>
  @elseif(Auth::user()->hasAnyRole([2,3]))
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> محتوى مادة {{$subject->name}} ل {{$subject->class->name}}</small></h1>
        </div>
      </div>
      <div class="col-lg-6">
        @if(Auth::user()->hasAnyRole([0,1,2]))
        <a href="{{route('subject.index')}}" class="btn btn-primary button-margin-header custom-but pull-left" > العودة
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
        @endif
          @if(Auth::user()->hasAnyRole([3]))
        <a href="{{route('class.myclasses')}}" class="btn btn-primary button-margin-header custom-but pull-left" > العودة
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
            @endif
      </div>
    </div>
  </div>
  @endif
    @if(Auth::user()->hasAnyRole([0,1,2]))

    <div id="table" class="row">
      <div class="card-deck">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card color-grey">
            <div class="card-body">
              <div class="card-header">اضافة اختبار للمادة</div>

              <form action="{{route('subject.attachTest', ['subject' => $subject->id])}}" enctype="multipart/form-data" method="POST">
                {!! csrf_field() !!}

                <div class="form-group">
                  <label for="lesson">اختر الاختبار :</label>
                  <select class="form-control form-control-select mt-3" id="test" name="test">
                    <option selected>-- اختر اختبار  --</option>

                    @foreach($tests as $test)


                      <option value="{{$test->id}}">{{$test->title}}</option>


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
@endif
<h1 class="bg-dark" style="color:#000;"> المحادثات</h1>
<table class="table text-dark" style="background: #ddd;color:#555!important;">
    <thead>
        <th>المادة</th>
        <th>الطالب</th>
        <th>فتح المحادثة</th>
    </thead>
    <tbody>
    @foreach($convs as $c)
        <tr>
            <td>
                {{\App\User::find($c->sender)->full_name}}
            </td>
            <td>
                {{\App\Subject::find($c->subject)->name}}
            </td>
            <td>
                <a href="/chats/{{$c->id}}/admin">Open</a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>

    <div id="table" class="row" style="background:#aaa;">


      <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
        <div class="card table-cards color-grey">
          <div class="card-body">
            <div class="content-header">
              <h2>
                <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الاختبارات المعتمدة ضمن {{$subject->name}}</small>
              </h2>
            </div><span>
            </span><table class="table table-bordered table-hover table-width">
              <thead>
              <tr>
                <th>عنوان الاختبار</th>
                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                <th>التفعيل</th>
                @endif
                <th>العرض</th>
                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                <th>التعديل</th>
                <th>الحذف</th>
                @endif
                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                <th>فصل عن المادة</th>
                 @endif
              </tr>
              </thead>
              <tbody>
              @foreach($subjectTests as $test)

                @if($test->active === 0 && Auth::user()->hasRole(3))
                @else
                  <tr>
                    <td>{{$test->title}}</td>
                    @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                    <td class="operations">
                      @if($test->active)
                        <form action="{{ route('test.deactivate', $test) }}" method="POST" id="activateForm">
                          {!! csrf_field() !!}
                          <button id="{{$test->id+1}}" class=" btn-xs delete-button" style="display:none;"></button>
                          <a herf="javascript:;" class="" onclick="$('#{{$test->id+1}}').click();" >
                            <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                          </a>
                        </form>
                      @else
                        <form action="{{ route('test.activate', $test) }}" method="POST" id="activateForm">
                          {!! csrf_field() !!}
                          <button id="{{$test->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                          <a herf="javascript:;" class="" onclick="$('#{{$test->id}}').click();" >
                            <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                          </a>
                        </form>
                      @endif
                    </td>
                    @endif
                    <td>
                      <div class="operations show">
                        <a href="{{ route('test.show', $test) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                      </div>
                    </td>
                    @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                      <td>
                        <div class="operations update">
                          <a href="{{ route('test.edit', $test) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                        </div>
                      </td>
                      <td>
                        <div class="operations delete">
                          <form action="{{ route('test.destroy', $test) }}" method="POST" id="deleteForm">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE">
                            <button id="{{$test->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                            <a herf="javascript:;" class="" onclick="$('#{{$test->id}}').click();" >
                              <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                            </a>
                          </form>

                        </div>
                      </td>
                      {{--<td>--}}
                          {{--<?php  $test = DB::table('subject_test')->where('subject_id', $subject->id)->first(); ?>--}}
                          {{--<?php  if(!is_null($test)): ?>--}}
                        {{--<div class="operations delete">--}}
                          {{--<form action="{{ route('subject.deleteTest',['subject' => $subject->id]) }}" method="POST" id="deleteForm">--}}
                            {{--{!! csrf_field() !!}--}}

                            {{--<button id="{{$test->id}}" class=" btn-xs delete-button" style="display:none;"></button>--}}
                            {{--<a herf="javascript:;" class="" onclick="$('#{{$test->test_id}}').click();" >--}}
                              {{--<i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>--}}
                            {{--</a>--}}
                          {{--</form>--}}
                        {{--</div>--}}
                          {{--<?php  endif; ?>--}}
                      {{--</td>--}}
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



    <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الوحدات الدراسية ضمن مادة ال {{$subject->name}}</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>اسم الوحدة</th>
                @if(Auth::user()->hasAnyRole([0,1,2]))
                <th>التفعيل</th>
                @endif
                <th>عدد دروس الوحدة</th>
                <th>الصف</th>
                <th>الترتيب</th>
                <th>العرض</th>
                @if(Auth::user()->hasAnyRole([0,1,2]))
                <th>التعديل</th>
                <th>الحذف</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($subject->units->sortBy('order_num') as $unit)
              <tr>
                <td>{{$unit->title}}</td>
                @if(Auth::user()->hasAnyRole([0,1,2]))
                <td class="operations">
                  @if($unit->active)
                  <form action="{{ route('unit.deactivate', $unit) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="dect{{$unit->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#dect{{$unit->id}}').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form>
                  @else
                  <form action="{{ route('unit.activate', $unit) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="act{{$unit->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#act{{$unit->id}}').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  @endif
                </td>
                @endif
                <td><?php echo $unit->lessons->count() ; ?></td>
                <td>{{$unit->subject->class->name}}</td>
                <th>{{$unit->order_num}}</th>
                <td>
                  <div class="operations show">
                    <a href="{{ route('unit.show', $unit) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                @if(Auth::user()->hasAnyRole([0,1,2]))
                <td>
                  <div class="operations update">
                    <a href="{{ route('unit.edit', $unit) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                <div class="operations delete">
                    <form action="{{ route('unit.destroy',['unit' => $unit->id]) }}" method="POST" id="deleteForm">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="DELETE">
                      <button id="del{{$unit->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#del{{$unit->id}}').click();" >
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

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>مدرسوا المادة</small>
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
              @foreach($teachersSubject as $teacherSubject)
              <tr>
                <td>{{$teacherSubject->username}}</td>


                @if(Auth::user()->hasAnyRole([0,1]))
                <td>
                  <div class="operations delete">
                    <form action="{{ route('subject.deleteteacher',['subject' => $subject->id, 'teacher_id'=>$teacherSubject->id]) }}" method="POST" id="deleteForm">
                       {!! csrf_field() !!}

                      <button id="delteacher{{$subject->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#delteacher{{$subject->id}}').click();" >
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


  @if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) )
  <div id="table2" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> إضافة مدرس لهذه المادة</small>
            </h2>
          </div>

          <form action="{{route('subject.addteacher',$subject)}}" method="POST">
            {!! csrf_field() !!}
            <div class="form-group">
              <label for="addteacher">اختر مدرس لاضافته الى هذه المادة :</label>
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

</div>

@endsection
