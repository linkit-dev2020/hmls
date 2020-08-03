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
  
  

  @if (Auth::user()->hasRole(0))
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> المشرفون</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>اسم المستخدم</th>
                <th>الحالة</th>
                
                <th> رقم الكملك  </th>
                <th>رقم الهاتف</th>
                <th>تاريخ الإضافة</th>
                
                <th>عرض</th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              @foreach($managers as $manager)
              <tr>
                <td>{{$manager->username}}</td>
                <td class="operations">
                  @if($manager->active)
                  <form action="{{ route('users.deactivate', $manager) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$manager->id+1}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$manager->id+1}}').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form> 
                  @else
                  <form action="{{ route('users.activate', $manager) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$manager->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$manager->id}}').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  @endif          
                </td>
                <td>{{$manager->tc}}</td>
                
                <td>{{$manager->phone}}</td>
                
                <td>{{$manager->created_at}}</td>
                  <td>
                  <div class="operations show">
                    <a href="{{ route('users.show', $manager) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations update">
                    <a href="{{ route('users.edit', $manager) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="{{ route('users.destroy',['user' => $manager->id]) }}" method="POST" id="deleteForm">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="DELETE">    
                      <button id="del{{$manager->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#del{{$manager->id}}').click();" >
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
