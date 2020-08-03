@extends('admin.layouts.master')

@section('content')

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة تشكرات الطلاب</small></h1>
        </div>
      </div>
    </div>
  </div>
  <div id="table" class="row">
    <div class="card-deck">       
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة تشكر <i class="fa fa-plus-square" aria-hidden="true"></i></div>
              
              <form action="{{route('studentthank.store')}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                <div class="form-group">
                  <label for="typeField">نوع التشكر :</label>
                  <select class="form-control form-control-select mt-3" id="typeField" name="type">
                    <option selected>-- اختر نوع التشكر --</option>
              >
                    <option value="img+text">صورة و نص</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">ملف الشكر :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="thankFile" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="thankFile">اختر ملف  
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="opinion"><h5>اكتب نص الرأي :</h5></label>
                  <textarea class="form-control" id="opinion" name="content" rows="3" required placeholder="نص التشكر"></textarea>
                </div>
                <div class="form-group">
                  <label for="orderField">ترتيب العرض :</label>
                  <input type="number" class="form-control form-control-range mt-3" id="orderField" name="order" />
                </div>
                <button type="submit" class="btn btn-success myhover">إضافة</button>
                <a href="{{route('studentthank.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

@endsection
