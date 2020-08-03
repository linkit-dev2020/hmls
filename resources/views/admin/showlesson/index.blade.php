@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدروس الأستعراضية</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('showlesson.create')}}" class="btn btn-success myhover BP" role="button">إضافة درس استعراضي<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>
  
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>الدروس الأستعراضية</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>اسم الدرس</th>
                <th>الملف</th>
                <th>الترتيب</th>
                <th>عرض</th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              @foreach($showLessons as $showLesson)
              <tr>
                <td>{{$showLesson->title}}</td>
                <td>
                  <div class="operations download">
                    <a href="{{ route('showlesson.show', $showLesson) }}"><i class="fa fa-file" style="font-size:18px;color:#454d55"></i></a>
                  </div>
                </td>
                <td>{{$showLesson->order}}</td>
                <td>
                  <div class="operations show">
                    <a href="{{ route('showlesson.show', $showLesson) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations update">
                    <a href="{{ route('showlesson.edit', $showLesson) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="{{ route('showlesson.destroy',['showlesson' => $showLesson->id]) }}" method="POST" id="deleteForm">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="DELETE">    
                      <button id="{{$showLesson->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#{{$showLesson->id}}').click();" >
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

</div>

@endsection