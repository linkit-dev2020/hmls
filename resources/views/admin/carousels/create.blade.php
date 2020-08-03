@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة القلاب</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('carousel.create')}}" class="btn btn-success myhover BP" role="button">إضافة صورة للقلاب<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>  

  <div id="table" class="row">
    <div class="card-deck">       
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة صورة للقلاب</div>
              
              <form action="{{route('carousel.store')}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                <div class="form-group">
                  <label for="">ملف الصورة :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="imageField" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="imageFeild">اختر ملف الصورة 
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="orderField">ترتيب العرض في القلاب :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="order">
                    <option selected>-- اختر ترتيب العرض --</option>
                    @foreach($orders as $order)
                    <option value="{{$order}}">{{$order}}</option>
                    @endforeach 
                  </select>
                </div>
                <button type="submit" class="btn btn-success myhover">إضافة</button>
                <a href="{{route('carousel.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

@endsection