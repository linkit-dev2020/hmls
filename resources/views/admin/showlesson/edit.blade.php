@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدرس الأستعراضي </small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل الدرس الأستعراضي<i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

              <form action="{{route('showlesson.update', $showLesson)}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                      {!! method_field('PUT')!!}
                <div class="form-group">
                  <label for="showLesson">اسم الدرس الأستعراضي:</label>
                  <input type="text" class="form-control" id="showLesson" name="title" value="{{$showLesson->title}}" required>
                </div>  
                <div class="form-group" id="lesson_url">
                  <label for="urlField"><h5>ادخل رابط الفديو :</h5></label>
                  <input type="url" class="form-control" id="urlField" name="src" value="{{$showLesson->url1}}" required placeholder="رابط الفديو"> 
                </div>
                <div class="form-group">
                  <label for="orderField">ترتيب عرض الدرس الأستعراضي :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="order">                   
                    @foreach($orders as $order)
                    <option value="{{$order}}" {{($order === $showLesson->order) ? "selected" : ""}}>{{$order}}</option>
                    @endforeach 
                  </select>
                </div>
                <button type="submit" class="btn btn-success myhover">تعديل</button>
                <a href="{{route('showlesson.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>

          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

@endsection