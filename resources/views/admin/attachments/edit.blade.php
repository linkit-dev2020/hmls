@extends('admin.layouts.master')

@section('content')


<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-6">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المرفقات</small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل المرفق <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

              <form action="{{route('attachment.update', ['attachment' => $attachment->id])}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                      {!! method_field('PUT') !!}
                <div class="form-group">
                  <label for="namne"><h5>اسم المرفق :</h5></label>
                  <input type="text" class="form-control" id="name" name="name" required value="{{$attachment->name}}" placeholder="اسم المرفق الجديد"> 
                </div>
                <div class="form-group">
                  <label for="attachmentable_typeField">مرتبط مع :</label>
                  <select class="form-control form-control-select mt-3" id="attachmentable_typeField" name="attachmentable_type">
                    <option value="App\Lesson" {{ $attachment->attachmentable_type === 'App\Lesson' ? "selected" : "" }}>درس</option>
                    <option value="App\Deneme" {{ $attachment->attachmentable_type === 'App\Deneme' ? "selected" : "" }}>دنيمي</option>
                    <option value="App\test" {{ $attachment->attachmentable_type === 'App\Test' ? "selected" : "" }}>اختبار</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="attachmentable_idField">تابع ل :</label>
                  <select class="form-control form-control-select mt-3" id="attachmentable_idField" name="attachmentable_id">
                    @foreach($lessons as $lesson)
                    <option value="{{$lesson->id}}" {{ $attachment->attachmentable_id === $lesson->id ? "selected" : "" }}>{{$lesson->title}}</option>
                    @endforeach
                    @foreach($denemes as $deneme)
                    <option value="{{$deneme->id}}" {{ $attachment->attachmentable_id === $deneme->id ? "selected" : "" }}>{{$deneme->title}}</option>
                    @endforeach
                    @foreach($tests as $test)
                    <option value="{{$test->id}}" {{ $attachment->attachmentable_id === $test->id ? "selected" : "" }}>{{$test->title}}</option>
                    @endforeach
                  </select>
                </div>
                <!--<div class="form-group">-->
                <!--  <label for="typeField">نوع المرفق :</label>-->
                <!--  <select class="form-control form-control-select mt-3" id="typeField" name="type">-->
                <!--    <option selected>-- اختر النوع --</option>-->
                <!--    <option value="file" {{ $attachment->type === 'file' ? "selected" : "" }}>ملف</option>-->
                <!--    <option value="image" {{ $attachment->type === 'image' ? "selected" : "" }}>صورة</option>-->
                <!--  </select>-->
                <!--</div>-->
                <!--<div class="form-group">-->
                <!--  <label for="">ملف المرفق :</label>-->
                <!--  <div class="input-group mt-3">-->
                <!--    <div class="custom-file">-->
                <!--      <input id="imageField" type="file" class="custom-file-input imageField" name="src">-->
                <!--      <label class="custom-file-label imageFieldLabel" for="imageFeild">اختر ملف المرفق -->
                <!--        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>-->
                <!--      </label>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
                
                   <div class="form-group">
                  <label for="type">اختر نوع المرفق</label>
                  <select class="form-control form-control-select mt-3" name="type" onchange="ShitFunction()" id="att_typeField">
                  <option selected>-- اختر النوع --</option>
                   <option value="video">فيديو</option>
                   <option value="image">صورة</option>
                   <option value="url">URL</option>
                   <option value="pdf">pdf</option>
                   <option value="word">word</option>
                  </select>
                </div>

                  <script>
                      ShitFunction();
                      function ShitFunction()
                      {
                          var val=document.getElementById('att_typeField').value;
                          switch (val) {
                              case 'video':
                                  document.getElementById('embaded_code').style.display='block';
                                  document.getElementById('att_file').style.display='none';
                                  document.getElementById('att_url').style.display='none';

                                  break;
                              case 'url':
                                  document.getElementById('att_url').style.display='block';
                                  document.getElementById('att_file').style.display='none';
                                  document.getElementById('embaded_code').style.display='none';
                                  break;
                              case 'image':
                                  document.getElementById('att_file').style.display='block';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('att_url').style.display='none';

                                  break;
                              case 'pdf':
                                  document.getElementById('att_file').style.display='block';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('att_url').style.display='none';
                                  break;

                              case 'word':
                                  document.getElementById('att_file').style.display='block';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('att_url').style.display='none';
                                  break;

                              default:
                                  document.getElementById('att_file').style.display='none';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('att_url').style.display='none';
                          }

                      }
                  </script>
                       <div class="form-group"  id="att_file" style="display: none;">
                  <label for="">ملف المرفق  :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="fileField" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="fileFeild">اختر ملف
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group" id="att_url" style="display: none;">
                  <label for="urlField"><h5>ادخل ال URL :</h5></label>
                  <input type="url" class="form-control" id="urlField" name="url_src" placeholder="ادخل ال URL">
                </div>

                <div class="form-group" id="embaded_code" style="display: none;">
                  <label for="embadedCode"><h5>ادخل رابط الفديو :</h5></label>
                  <input type="text" class="form-control" id="embadedCode" name="embadedCode_src" placeholder="رابط الفديو">
                </div>


                <button type="submit" class="btn btn-success button1">تعديل</button>
                <a href="{{route('attachment.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

@endsection
