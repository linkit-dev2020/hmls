@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة القلاب </small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل صورة القلاب</div>
            <div class="card-body">

              <form action="{{route('carousel.update', $carousel)}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                      {!! method_field('PUT')!!}
                <img src="{{$carousel->src}}" alt="Picture" width="80%" height="60%" style="margin-bottom: 20px;">
                <div class="form-group">
                  <label for="">ملف الصورة :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="updateImageField" type="file" class="custom-file-input imageField" name="src" value="{{$carousel->src}}">
                      <label class="custom-file-label imageFieldLabel" for="updateImageField">اختر صورة جديدة 
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="orderField">ترتيب العرض في القلاب :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="order">                   
                    @foreach($orders as $order)
                    <option value="{{$order}}" {{($order === $carousel->order) ? "selected" : ""}}>{{$order}}</option>
                    @endforeach 
                  </select>
                </div>
                <button type="submit" class="btn btn-success myhover">تعديل</button>
                <a href="{{route('carousel.index')}}" class="btn btn-default button2" style="margin-right:5px">إلغاء</a>
              </form>

          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

@endsection