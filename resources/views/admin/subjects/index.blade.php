@extends('admin.layouts.master')

@section('content')

<div id="content">
  @if(Auth::user()->hasAnyRole([0,1]))
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المواد الدراسية</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('subject.create')}}" class="btn btn-success custom-but BP" >إضافة مادة <div><i class="fa fa-plus-square" aria-hidden="true"></i></div></a>
      </div>
    </div>
  </div>
  @elseif(Auth::user()->hasAnyRole([2,3]))
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> المواد الدراسية</small></h1>
        </div>
      </div>
    </div>
  </div>
  @endif
  
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12  col-sm-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> المواد الدراسية</small>
            </h2>
          </div>
          <table id="myTable" style="width: 90%!important;;">
            <thead>
              <tr> 
                <th>اسم المادة</th>
                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                <th>التفعيل</th>
                @endif
                <th>الصف</th>
                <th>عدد الوحدات الدراسية</th>
                <th>قابلية التنزيل</th>
                <th>عرض</th>
                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
                <th>تعديل</th>
                <th>حذف</th>
                @endif
                  <th>الترتيب</th>

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
                @if($subject->downloable)
                <td>قابلة</td>
                @elseif(!$subject->downloable)
                <td>غير قابلة</td>
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
                
                @endif
                <td>{{$subject->order_num}}</td>

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
