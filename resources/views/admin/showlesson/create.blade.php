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
    <div class="card-deck">       
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة درس استعراضي <i class="fa fa-plus-square" aria-hidden="true"></i></div>
              
              <form action="{{route('showlesson.store')}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                <div class="form-group">
                  <label for="showLesson"><h5>الدرس الأستعراضي :</h5></label>
                  <input type="text" class="form-control" id="showLesson" name="title" required placeholder="اسم الدرس الأستعراضي الجديد"> 
                </div>
                <div class="form-group" id="lesson_url">
                  <label for="urlField"><h5>ادخل رابط الفديو :</h5></label>
                  <input type="url" class="form-control" id="urlField" name="src" required placeholder="رابط الفديو"> 
                </div>
                <div class="form-group">
                  <label for="orderField">ترتيب العرض :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="order">
                    <option selected>-- اختر ترتيب العرض --</option>
                    @foreach($orders as $order)
                    <option value="{{$order}}">{{$order}}</option>
                    @endforeach 
                  </select>
                </div>
                <button type="submit" class="btn btn-success myhover">إضافة</button>
                <a href="{{route('showlesson.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

@endsection