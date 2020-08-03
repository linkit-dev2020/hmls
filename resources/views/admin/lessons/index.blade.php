@extends('admin.layouts.master')

@section('content')

<div id="content">
  
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدروس </small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
        <a href="{{route('lesson.create')}}" class="btn btn-success myhover BP" role="button">إضافة درس<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
        @endif
      </div>
    </div>
  </div>

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 ">
      <div class="card table-cards color-grey">
        <div class="content-header">
          <h2>
            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدروس</small>
          </h2>
        </div>
        <div class="card-body">
          <table id="myTable" class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>عنوان الدرس</th>
                <th>نوع الملف</th>
                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                <th>التفعيل</th>
                @endif
                <th>العرض</th>
                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                <th>التعديل</th>
                <th>الحذف</th>

                @endif
                         <th>الترتيب</th>

                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                <th>فصل عن مادة</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($lessons as $lesson)
              <tr>
                <td>
                    {{$lesson->title}}
                 </td>
                <td>{{$lesson->type}}
               
                </td>
                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                <td class="operations">
                  @if($lesson->active)
                  <form action="{{ route('lesson.deactivate', $lesson) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$lesson->id}}deact" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$lesson->id}}deact').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form> 
                  @else
                  <form action="{{ route('lesson.activate', $lesson) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$lesson->id}}act" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$lesson->id}}act').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  @endif          
                </td>
                @endif
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
                     
                               <button id="{{$lesson->id}}del" class=" btn-xs delete-button" style="display:none;"></button>
                 
                      </span>
                    </form> 
                     <form action="{{ route('lesson.destroy', $lesson) }}" method="POST" id="deleteForm">
                    {!! csrf_field() !!}
                    <button id="{{$lesson->id+1}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$lesson->id}}del').click();" >
                      <i class="fa fa-trash" aria-hidden="true" style="font-size:18px;color:red;cursor: pointer;"></i>
                    </a>
                  </form> 
               
                  </div>
                </td>
                   @endif
                <td>{{$lesson->order_num}}</td>

                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                <td>
               <?php  $unit = DB::table('lesson_unit')->where('lesson_id', $lesson->id)->first(); ?>
                  <?php  if(!is_null($unit)): ?>
                  <div class="operations delete">
                    <form action="{{ route('unit.deletelesson',['unit' => $unit->unit_id]) }}" method="POST" id="deleteForm">
                      {!! csrf_field() !!}
                      <button id="{{$unit->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#{{$unit->unit_id}}').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </a>
                    </form>
                  </div>
                  <?php  endif; ?>
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

@endsection
