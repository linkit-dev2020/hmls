@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-6">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة روابط تطبيق الواتس أب </small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('whatsapplink.create')}}" class="btn btn-success myhover BP" role="button">إضافة رابط <div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>  

  <div id="table" class="row">
    <div class="card-deck">       
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة رابط</div>
              
              <form action="{{route('whatsapplink.store')}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                <div class="form-group">
                  <label for="classRoom"><h5>رابط التطبيق :</h5></label>
                  <input type="url" class="form-control" id="classRoom" name="url" required placeholder="الرابط"> 
                </div>
                <div class="form-group">
                  <label for="orderField">النوع :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="linkable_type">
                    <option selected>-- اختر النوع --</option>
                    <option value="App\ClassRoom">رابط لصف</option>
                    <option value="App\Course">رابط لكورس</option> 
                  </select>
                </div>
                <div class="form-group">
                  <label for="orderField">اختر الصف أو الكورس :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="linkable_id">
                    <option selected>-- اختر الصف أو الكورس --</option>
                    @foreach($classes as $class)
                    <option value="{{$class->id}}">{{$class->name}}</option>
                    @endforeach
                    @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->title}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="orderField">اختر نوع الرابط للصفوف من 1 إلى 4 :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="type">
                    <option selected>-- اختر النوع --</option>
                    <option value="lessons">رابط دروس</option>
                    <option value="homeworks">رابط وظائف</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="orderField">الترتيب :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="order">
                    <option selected>-- اختر الترتيب --</option>
                    @foreach($orders as $order)
                    <option value="{{$order}}">{{$order}}</option>
                    @endforeach 
                  </select>
                </div>
                
                <button type="submit" class="btn btn-success myhover">إضافة</button>
                <a href="{{route('whatsapplink.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

@endsection