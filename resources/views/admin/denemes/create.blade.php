@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدينيمي</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('deneme.create')}}" class="btn btn-success myhover BP" role="button">إضافة دينيمي<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>  

  <div id="table" class="row">
    <div class="card-deck">       
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة دينيمي  <i class="fa fa-plus-square" aria-hidden="true"></i></div>
              
              <form action="{{route('deneme.store')}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                <div class="form-group">
                  <label for="denemeTitle"><h5>عنوان الدينيمي :</h5></label>
                  <input type="text" class="form-control" id="denemeTitle" name="title" required placeholder="اكتب عنوان للدينيمي"> 
                </div>
                <div class="form-group">
                  <label for="orderField">الصف :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="class_id">
                    <option selected>-- اختر الصف  --</option>
                    @foreach($classes as $class)
                    <option value="{{$class->id}}">{{$class->name}}</option>
                    @endforeach 
                  </select>
                </div>
                <div class="form-group">
                  <label for="orderField">الفصل :</label>
                  <select class="form-control form-control-select mt-3" id="orderField" name="term">
                    <option selected>-- اختر الفصل --</option>
                    <option value="1">{{$terms[0]}}</option>
                    <option value="2">{{$terms[1]}}</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="deneme_type">النوع :</label>
                  <select class="form-control form-control-select mt-3" id="deneme_type" name="type">
                  <option selected>-- اختر النوع --</option>
                   <option value="video">فديو</option>
                   <option value="image">صورة</option>
                   <option value="url">URL</option>
                   <option value="pdf">pdf</option>
                   <option value="word">word</option>
                  </select>
                </div>
                <div class="form-group"  id="deneme_file" style="display: none;">
                  <label for="">ملف الدينيمي :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="fileField" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="fileFeild">اختر ملف 
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group" id="deneme_url" style="display: none;">
                  <label for="urlField"><h5>ادخل ال URL :</h5></label>
                  <input type="url" class="form-control" id="urlField" name="url_src" placeholder="ادخل ال URL"> 
                </div>

                <div class="form-group" id="deneme_embaded_code" style="display: none;">
                  <label for="embadedCode"><h5>ادخل رابط الفديو :</h5></label>
                  <input type="url" class="form-control" id="embadedCode" name="embadedCode_src" placeholder="رابط الفديو"> 
                </div>

                <div class="radioG">
                  <h5>تفعيل الدينيمي :</h5>
                  <div class="radio">
                    <input type="radio" name="active" value="1" checked>
                    <label>فعال</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" value="0">
                    <label>غير فعال</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-success myhover">إضافة</button>
                <a href="{{route('deneme.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

@endsection