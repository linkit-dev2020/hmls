@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الملاحظات</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('notes.create')}}" class="btn btn-success custom-but BP" >إضافة ملاحظة <div><i class="fa fa-plus-square" aria-hidden="true"></i></div></a>
      </div>
    </div>
  </div>
  
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الملاحظات </small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>الصف الدراسي</th>
                <th>النوع</th>
                <th>المحتوى</th>
                <th>عرض</th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              @foreach($notes as $note)
              <tr>
                  @if($note->type === 'public')
                      <td>جميع الصفوف</td>
                  @elseif($note->type === 'private')
                      <td>{{$note->class->name}}</td>
                @endif
                @if($note->type === 'public')
                <td>عامة</td>
                @elseif($note->type === 'private')
                <td> خاصة</td>
                @endif
                <td>{{$note->content}}</td>
                <td>
                
                  <div class="operations show">
                    <a href="{{ route('notes.show', $note) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations update">
                    <a href="{{ route('notes.edit', $note) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="{{ route('notes.destroy',['note' => $note->id]) }}" method="POST" id="deleteForm">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="DELETE">    
                      <button id="{{$note->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#{{$note->id}}').click();" >
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
