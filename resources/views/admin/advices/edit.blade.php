@extends('admin.layouts.master')

@section('content')


<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i>إدارة النصائح</small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل النصيحة <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

            <form action="{{route('advice.update',$advice)}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                      {!! method_field('PUT') !!}
                <div class="form-group">
                  <label for="adviceTitle"><h5>عنوان النصيحة :</h5></label>
                  <input type="text" class="form-control" id="adviceTitle" name="title" required value="{{$advice->title}}">
                </div>
                <!-- <div class="form-group">
                  <label for="type">الصف الذي تتبع إليه النصيحة :</label>
                  <select class="form-control form-control-select mt-3" id="type" name="class_id">
                    <option selected>-- اختر الصف   --</option>
                    @foreach($classes as $class)
                    <option value="{{$class->id}}">{{$class->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class ="form-control">
                    <label for="type"> الدورة التي تتبع إليها النصيحة :</label>
                    <select name="course_id" id="course_id" class="form-control form-control-select mt-3">
                    <option selected>-- اختر الدورة --</option>
                    @foreach($courses as $course)
                    <option value="{{$course->id}}">دورة {{$course->title}}</option>
                    @endforeach
                  </select>
                  </div> -->
        <div class="form-group">
                  <label for="type">نوع النصيحة :</label>
                  <select class="form-control form-control-select mt-3" name="type" id="lesson_type">
                  <option selected>-- اختر النوع --</option>
                  
                   <option value="audio">صوت</option>
                    <option value="video">فيديو</option>
                
                  </select>
                </div>
                          
              <div class="form-group" id="lesson_file" >
                  <label for="">ملف  النصيحة:</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="lessonFile" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="lessonFile">اختر ملف النصيحة 
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>
                </div>
    
                <div class="form-group" id="embaded_code" style="display: none;">
                  <label for="embadedCode"><h5>ادخل رابط الفديو :</h5></label>
                  <input type="url" class="form-control" id="embadedCode" name="embadedCode_src" placeholder="رابط الفديو"> 
                </div>

   
                <div class="radioG">
                  <h5>تفعيل النصيحة :</h5>
                  <div class="radio">
                    <input type="radio" name="active" id="active" value="1"  {{$advice->active ? "checked" : ""}}>
                    <label for="active">مفعلة</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" id="deactive" value="0"  {{!$advice->active ? "checked" : ""}}>
                    <label for="deactive">غير مفعلة</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-success myhover button1">تعديل</button>
                <a href="{{route('advice.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>

          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

@endsection