@extends('admin.layouts.master')

@section('content')

<div id="content">

<div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المستخدمين</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('users.create')}}" class="btn btn-success custom-but BP" >إضافة مستخدم <div><i class="fa fa-plus-square" aria-hidden="true"></i></div></a>
      </div>
    </div>
  </div>


@if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1))
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> المدرسون</small>
            </h2>
          </div>
          <table id="myTable" class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>اسم المستخدم</th>
                <th>الحالة</th>
                
                <th>رقم الكملك</th>
                <th>رقم الهاتف</th>
                <th>تاريخ الإضافة</th>
                <th> عرض </th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              @foreach($teachers->sortByDesc('created_at') as $teacher)
              <tr>
                <td>{{$teacher->username}}</td>
                <td class="operations">
                  @if($teacher->active)
                  <form action="{{ route('users.deactivate', $teacher) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$teacher->id+1}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$teacher->id+1}}').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form> 
                  @else
                  <form action="{{ route('users.activate', $teacher) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$teacher->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$teacher->id}}').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  @endif          
                </td>
                <td>{{$teacher->tc}}</td>
                
                <td>{{$teacher->phone}}</td>
                <td>{{$teacher->created_at}}</td>
 <td>
                  <div class="operations show">
                    <a href="{{ route('users.show', $teacher) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations update">
                    <a href="{{ route('users.edit', $teacher) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="{{ route('users.destroy',['user' => $teacher->id]) }}" method="POST" id="deleteForm">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="DELETE">    
                      <button id="del{{$teacher->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#del{{$teacher->id}}').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </a>
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
  @endif
</div>
@endsection
