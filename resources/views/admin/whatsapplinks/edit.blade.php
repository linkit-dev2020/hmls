@extends('admin.layouts.master')

@section('content')


<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-6">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة روابط الواتس أب</small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل الرابط <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

              <form action="{{route('whatsapplink.update', ['whatsappLink' => $whatsappLink->id])}}" method="POST">
                      {!! csrf_field() !!}
                      {!! method_field('PUT') !!}
                <div class="form-group">
                  <label for="classRoom"><h5>رابط التطبيق :</h5></label>
                  <input type="url" class="form-control" id="classRoom" name="url" required placeholder="الرابط" value="{{$whatsappLink->url}}"> 
                </div>
                <div class="form-group">
                  <label for="orderField">النوع :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="linkable_type">
                    <option value="class" {{$whatsappLink->linkable_type === 'class' ? "selected" : ""}}>رابط لصف</option>
                    <option value="course" {{$whatsappLink->linkable_type === 'course' ? "selected" : ""}}>رابط لكورس</option> 
                  </select>
                </div>
                <div class="form-group">
                  <label for="orderField">اختر الصف أو الكورس :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="linkable_id">
                    @foreach($classes as $class)
                    <option value="{{$class->id}}" {{$whatsappLink->linkable_id === $class->id ? "selected" : ""}}>{{$class->name}}</option>
                    @endforeach
                    @foreach($courses as $course)
                    <option value="{{$course->id}}" {{$whatsappLink->linkable_id === $course->id ? "selected" : ""}}>{{$course->title}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="orderField">اختر نوع الرابط للصفوف من 1 إلى 4 :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="type">
                    <option value="lessons" {{$whatsappLink->type === 'lessons' ? "selected" : ""}}>رابط دروس</option>
                    <option value="homeworks"  {{$whatsappLink->type === 'homeworks' ? "selected" : ""}}>رابط وظائف</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="orderField">الترتيب :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="order">
                    @foreach($orders as $order)
                    <option value="{{$order}}"  {{$whatsappLink->order === $order ? "selected" : ""}}>{{$order}}</option>
                    @endforeach 
                  </select>
                </div>
                <button type="submit" class="btn btn-success button1">تعديل</button>
                <a href="{{route('whatsapplink.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

@endsection