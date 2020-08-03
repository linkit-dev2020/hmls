@extends('admin.layouts.master')

@section('content')

<div id="content">
  
  @if(Auth::user()->hasAnyRole([0,1]))
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدورات الدراسية</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('course.create')}}" class="btn btn-success myhover BP" role="button">إضافة دورة دراسية<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>
  @elseif(Auth::user()->hasAnyRole([2,3]))
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> الدورات الدراسية</small></h1>
        </div>
      </div>
    </div>
  </div>
  @endif

  @if(Auth::user()->hasAnyRole([0,1,3]))
  <div id="table" class="row">
    <div class="col-lg-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="content-header">
          <h2>
            @if(Auth::user()->hasAnyRole([0,1]))
            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>الدورات الدراسية</small>
            @elseif(Auth::user()->hasAnyRole([2,3]))
            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>طلبات الأنضمام إلى الدورات الدراسية المتوفرة </small>
            @endif
          </h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>اسم الدورة</th>
                @if(Auth::user()->hasAnyRole([0,1]))
                <th>التفعيل</th>
                <th>العرض</th>
                <th>التعديل</th>
                <th>الحذف</th>
                <th>الترتيب</th>
               <th>تاريخ الاضافة</th>
                                      <th>تاريخ التعديل</th>
            
                @endif
                @if(Auth::user()->hasRole(3))
                <th>طلب انضمام</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($courses as $course)
              <tr>
                <td>{{$course->title}}</td>
                @if(Auth::user()->hasAnyRole([0,1,2]))
                @if($course->active)
                <td>فعال</td>
                @elseif(!$course->active)
                <td>غير فعال</td>
                @endif
                <td>
                  <div class="operations show">
                    <a href="{{ route('course.show', $course) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations update">
                     <a href="{{ route('course.edit', $course) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="{{ route('course.destroy', $course) }}" method="POST" id="deleteForm">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="DELETE">    
                      <button id="{{$course->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#{{$course->id}}').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </a>
                    </form>
                    
                  </div>
                </td>
                  <td>{{$course->order_num}}</td>
                  <td>{{$course->created_at}}</td>
                  <td>{{$course->updated_at}}</td>
                @endif

              
                @if(Auth::user()->hasRole(3))
                <td>
                    <form action="{{ route('courserequest.store') }}" method="POST" id="makeCourseFreeForm" style="display:inline; margin-right:10px;">
                       {!! csrf_field() !!}
                       <input type="hidden" name="course_id" value="{{$course->id}}">
                       <input type="submit" class="btn btn-success" value="انضم">
                    </form>
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
  @endif


  @if(Auth::user()->hasAnyRole([2]))

  <div id="table" class="row">
    <div class="col-lg-12">
      <div class="card table-cards color-grey">
        <div class="content-header">
          <h2>
            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>الدورات الدراسية المنضم إليها</small>
          </h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>اسم الدورة</th>
                <th>العرض</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mycourses as $mycourse)
              <tr>
                <td>{{$mycourse->title}}</td>
                
                <td>
                  <div class="operations show">
                    <a href="{{ route('course.show', $mycourse) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
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

  @endif
</div>

@endsection
