@extends('admin.layouts.master')

@section('content')


<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المواد التدريسية</small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل المادة التدريسية <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

              <form action="{{route('subject.update', ['subject' => $subject->id])}}" method="POST" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      {!! method_field('PUT') !!}
                <div class="form-group">
                  <label for="subject"><h5>المادة الدراسية :</h5></label>
                  <input type="text" class="form-control" id="subject" name="name" required value="{{$subject->name}}">


                    <label for="order"><h5>ترتيب المادة ضمن الصف </h5></label>
                    <input type="number" class="form-control" id="order" min="1" max="9999999"  name="order" required placeholder="ترتيب المادة ضمن الصف " value="{{$subject->order_num}}">
                </div>
                <div class="radioG">
                  <h5>تفعيل الدورة التدريسية :</h5>
                  <div class="radio">
                    <input type="radio" name="active" value="1" {{$subject->active ? "checked" : ""}}>
                    <label>مفعلة</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" value="0" {{!$subject->active ? "checked" : ""}}>
                    <label>غير مفعلة</label>
                  </div>
                </div>
                   <div class="form-group">
                  <label for="classField"> الصف الدراسي الحالي  :   {{$subject->class->name}} </label>    
                  
                  
                  <select class="form-control form-control-select mt-3" id="classField" name="class_id">
                    @foreach($classes as $class)
                    <option value="{{$class->id}}" {{$class->id === $subject->class->id ? "selected" : ""}}>{{$class->name}}</option>
                    @endforeach 
                  </select>
                </div>
                <div class="radioG">
                  <h5>قابلية المادة للتنزيل :</h5>
                  <div class="radio">
                    <input type="radio" name="downloable" value="1" {{$subject->downloable ? "checked" : ""}}>
                    <label>قابلة</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="downloable" value="0" {{!$subject->downloable ? "checked" : ""}}>
                    <label>غير قابلة</label>
                  </div>
                </div>
				
				<div class="form-group">

                  <label for="">صورة الغلاف :</label>

                  <div class="input-group mt-3">

                    <div class="custom-file">

                      <input id="imageField"  type="file" class="custom-file-input imageField" name="cover">

                      <label class="custom-file-label imageFieldLabel" for="imageFeild">اختر ملف الصورة 

                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>

                      </label>

                    </div>

                  </div>

                </div>

                <button type="submit" class="btn btn-success button1">تعديل</button>
                <a href="{{route('subject.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

@endsection
