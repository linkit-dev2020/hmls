@extends('admin.layouts.master')

@section('content')

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المواد الدراسية</small></h1>
        </div>
      </div>
    </div>
  </div>
  <div id="table" class="row">
    <div class="card-deck">       
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة مادة دراسية <i class="fa fa-plus-square" aria-hidden="true"></i></div>
              
              <form action="{{route('subject.store')}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                <div class="form-group">
                    <label for="subject"><h5>المادة الدراسية :</h5></label>
                    <input type="text" class="form-control" id="subject" name="name" required placeholder="اسم المادة الجديدة">



                    <label for="order"><h5>ترتيب المادة ضمن الصف </h5></label>
                    <input type="number" class="form-control" id="order" min="1" max="9999999" name="order" required placeholder="ترتيب المادة ضمن الصف ">
                </div>
                <div class="radioG">
                  <h5>تفعيل المادة التدريسية :</h5>
                  <div class="radio">
                    <input type="radio" name="active" value="1" checked>
                    <label>مفعلة</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" value="0">
                    <label>غير مفعلة</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="classField">الصف الدراسي :</label>
                  @if($selectedclass === null)
                    <select class="form-control form-control-select mt-3" id="classField" name="class_id">
                      <option selected>-- اختر الصف الدراسي --</option>
                      @foreach($classes as $class)
                      <option value="{{$class->id}}">{{$class->name}}</option>
                      @endforeach
                    </select>
                  @elseif($selectedclass != null)
                    <select class="form-control form-control-select mt-3" id="classField" name="class_id" readonly>
                      <option value="{{$selectedclass->id}}">{{$selectedclass->name}}</option>
                    </select>
                  @endif
                </div>
                <div class="radioG">
                  <h5>قابلية المادة للتنزيل :</h5>
                  <div class="">
                    <input type="radio" name="downloable" value="1" checked>
                    <label>قابلة</label>
                  </div>
                  <div class="">
                    <input type="radio" name="downloable" value="0">
                    <label>غير قابلة</label>
                  </div>
                </div>
				
				<div class="form-group">

                  <label for="">صورة الغلاف :</label>

                  <div class="input-group mt-3">

                    <div class="custom-file">

                      <input id="imageField" required type="file" class="custom-file-input imageField" name="cover">

                      <label class="custom-file-label imageFieldLabel" for="imageFeild">اختر ملف الصورة 

                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>

                      </label>

                    </div>

                  </div>

                </div>
                <button type="submit" class="btn btn-success button1">إضافة</button>
                <a href="{{route('subject.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

@endsection
