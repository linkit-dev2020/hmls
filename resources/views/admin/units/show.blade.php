@extends('admin.layouts.master')

@section('content')

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الوحدات الدراسية</small></h1>
        </div>
      </div>
        @if(Auth::user()->hasAnyRole([0,1,2]))
      <div class="col-lg-4">
        <a href="{{route('unit.index')}}" class="btn btn-primary button-margin-header custom-but pull-left" > إدارة كافة الوحدات
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div>
        <div class="col-lg-2">
                <a href="/lessons/create?selectedunit={{$unit->id}}" class="btn btn-success button-margin-header" style="margin-right: 22px" >إضافة درس
                    <i class="fa fa-plus" aria-hidden="true" style="font-size:16px"></i>
                </a>
            </div>
                  @endif
    </div>
  </div>

    @if(Auth::user()->hasAnyRole([0,1,2]))
      <div id="table" class="row">
    <div class="card-deck">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">اضافة درس للوحدة</div>

              <form action="{{route('unit.attachlesson', ['unit' => $unit->id])}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}

                <div class="form-group">
                  <label for="lesson">اختر الدرس :</label>
                  <select class="form-control form-control-select mt-3" id="lesson" name="lesson">
                    <option selected>-- اختر درس --</option>

                    @foreach($lessons as $lesson)


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

    @endif

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدروس المعتمدة ضمن {{$unit->title}}</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>عنوان الدرس</th>
                  @if(Auth::user()->hasAnyRole([0,1,2]))
                <th>التفعيل</th>
                  @endif
                  <th>المقدمة</th>
                  <th>الترتيب</th>
                <th>العرض</th>
                  @if(Auth::user()->hasAnyRole([0,1,2]))
                <th>التعديل</th>
                <th>الحذف</th>
                      <th>فصل عن الوحدة</th>
                      @endif
              </tr>
            </thead>
            <tbody>
              @foreach($unitLessons as $lesson)

              @if($lesson->active === 0 && Auth::user()->hasRole(3))
              @else
              <tr>
               <td>{{$lesson->title}}</td>
                  @if(Auth::user()->hasAnyRole([0,1,2]))
               <td>

                @if($lesson->active)
                  <form action="{{ route('lesson.deactivate', $lesson) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="dectivate{{$lesson->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#dectivate{{$lesson->id}}').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form>
                  @else
                  <form action="{{ route('lesson.activate', $lesson) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="activate{{$lesson->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#activate{{$lesson->id}}').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  @endif
               </td>
                  @endif
               <td>{{$lesson->intro}}</td>
               <td>{{$lesson->order_num}}</td>
               <td>
                  <div class="operations show">
                    <a href="{{ route('lesson.show', $lesson) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
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
                      <td>
                          <div class="operations delete">
                              <form action="{{ route('unit.deletelesson',['unit' => $unit->id]) }}" method="POST" id="deleteForm">
                                  {!! csrf_field() !!}
                                  <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                                  <button id="deattach{{$lesson->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                                  <a herf="javascript:;" class="" onclick="$('#deattach{{$lesson->id}}').click();" >
                                      <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                  </a>
                              </form>
                          </div>
                      </td>
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

@endsection
