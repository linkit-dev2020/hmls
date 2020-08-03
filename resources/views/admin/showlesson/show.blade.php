<?php 
    $array = explode('/', $showLesson->src);
    $file_name = $array[2];
?>
@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدرس الأستعراضي</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        
      </div>
      <div class="col-lg-6">
        <a href="{{route('showlesson.index')}}" class="btn btn-primary button-margin-header custom-but pull-left" > إدارة الدروس الأستعراضي 
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div> 
    </div>
  </div>

  <div id="table" class="row">
    <div class="col-lg-6">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> فيديو الدرس الاستعراضي</small>
            </h2>
          </div>
          
          {!! $showLesson->src !!}

        </div>
      </div>
    </div>
  </div>
        
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
              <h2>
                <small>
                  <i class="fa fa-file-archive-o" aria-hidden="true" style="font-size:24px;"></i>
                  <span style="direction:ltr; display: table-cell;"> {{$showLesson->title}}</span>
                </small>
              </h2>
            </div>
          <div  class="border-padding">
            <table class="show-table">
              <thead>
                  <tr>
                      <th><span class="border-padding">بعض المعلومات عن الدرس</span></th>
                      <th></th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>اسم الدرس</td>
                      <td>:</td>
                      <td style="direction:ltr;">{{$showLesson->title}}</td>
                  </tr>
                  <tr>
                      <td>ترتيب عرضه</td>
                      <td>:</td>
                      <td>{{$showLesson->order}}</td>
                  </tr>
              </tbody>
            </table>
          </div>
          
          <form action="{{ route('showlesson.destroy',['showlesson' => $showLesson]) }}" method="POST" id="deleteForm">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="DELETE">    
                      <button class=" btn btn-danger custom-but">حذف الملف</button>     
          </form>       
                  
        </div>
      </div>
    </div>
  </div>

    <div id="table" class="row">
        <div class="card-deck">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card color-grey">
                    <div class="card-body">
                        <div class="card-header">إضافة مرفق</div>

                        <form action="{{route('attachment.store')}}" enctype="multipart/form-data" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="namne"><h5>اسم المرفق :</h5></label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="اسم المرفق الجديد">
                            </div>
                            <div class="form-group" style="display: none">
                                <label for="attachmentable_typeField">مرتبط مع :</label>
                                <select value="App\Lesson" class="form-control form-control-select mt-3" id="attachmentable_typeField" name="attachmentable_type">
                                </select>
                            </div>
                            <div class="form-group" style="display: none">
                                <label for="attachmentable_idField">تابع ل :</label>
                                <select class="form-control form-control-select mt-3" id="attachmentable_idField"
                                        name="attachmentable_id" value="{{$lesson->id}}">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="typeField">نوع المرفق :</label>
                                <select class="form-control form-control-select mt-3" id="typeField" name="type">
                                    <option selected>-- اختر النوع --</option>
                                    <option value="file">ملف</option>
                                    <option value="image">صورة</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">ملف المرفق :</label>
                                <div class="input-group mt-3">
                                    <div class="custom-file">
                                        <input id="imageField" type="file" class="custom-file-input imageField" name="src">
                                        <label class="custom-file-label imageFieldLabel" for="imageFeild">اختر ملف المرفق
                                            <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success myhover">إضافة</button>
                            <a href="{{route('attachment.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection



