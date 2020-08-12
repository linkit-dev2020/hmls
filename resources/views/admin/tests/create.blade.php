@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الوظائف</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('test.create')}}" class="btn btn-success myhover BP" role="button">إضافة الوظائف <div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>

  <div id="table" class="row">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة وظيفة</div>

              <form action="{{route('test.store')}}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                <div class="form-group">
                  <label for="test"><h5>اسم الوظيفة :</h5></label>
                  <input type="text" class="form-control" id="test" name="title" required placeholder="عنوان الإختبار الجديد">
                </div>
              <!--  <div class="form-group">
                  <label for="termField">الفصل الدراسي :</label>
                  <select class="form-control form-control-select mt-3" id="termField" name="term">
                    <option selected>-- اختر الفصل الدراسي --</option>
                    <option value="1">الفصل الأول</option>
                    <option value="2">الفصل الثاني</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="subtestField">الأمتحان :</label>
                  <select class="form-control form-control-select mt-3" id="subtestField" name="sub_test">
                    <option selected>-- اختر الأمتحان الدراسي --</option>
                    <option value="1">الأمتحان الأول</option>
                    <option value="2">الأمتحان الثاني</option>
                  </select>
                </div>-->
                <input type="hidden" name="sub_test" value="1"/>
                <input type="hidden" name="term" value="1"/>

           <div class="form-group">
                  <label for="type">نوع الاختبار :</label>
                  <select class="form-control form-control-select mt-3" name="type" id="test_typeField" onchange="ShitFunction()">
                  <option selected>-- اختر النوع --</option>
                   <option value="video">فيديو</option>
                   <option value="image">صورة</option>
                   <option value="url">URL</option>
                   <option value="pdf">pdf</option>
                   <option value="word">word</option>
                  </select>
                </div>

                <script>
                    function ShitFunction()
                    {
                        var val=document.getElementById('test_typeField').value;
                        switch (val) {
                            case 'video':
                                document.getElementById('embaded_code').style.display='block';
                                document.getElementById('test_file').style.display='none';
                                document.getElementById('test_url').style.display='none';

                                break;
                            case 'url':
                                document.getElementById('test_url').style.display='block';
                                document.getElementById('test_file').style.display='none';
                                document.getElementById('embaded_code').style.display='none';
                                break;
                            case 'image':
                                document.getElementById('test_file').style.display='block';
                                document.getElementById('embaded_code').style.display='none';
                                document.getElementById('test_url').style.display='none';

                                break;
                            case 'pdf':
                                document.getElementById('test_file').style.display='block';
                                document.getElementById('embaded_code').style.display='none';
                                document.getElementById('test_url').style.display='none';
                                break;

                            case 'word':
                                document.getElementById('test_file').style.display='block';
                                document.getElementById('embaded_code').style.display='none';
                                document.getElementById('test_url').style.display='none';
                                break;

                            default:
                                document.getElementById('test_file').style.display='none';
                                document.getElementById('embaded_code').style.display='none';
                                document.getElementById('test_url').style.display='none';
                        }


                    }
                </script>
                <div class="form-group"  id="test_file" style="display: none;">
                  <label for="">ملف الاختبار  :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="fileField" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="fileFeild">اختر ملف
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>

                </div>
                <div class="form-group" id="test_url" style="display: none;">
                  <label for="urlField"><h5>ادخل ال URL :</h5></label>
                  <input type="url" class="form-control" id="urlField" name="url_src" placeholder="ادخل ال URL">
                </div>

                <div class="form-group" id="embaded_code" style="display: none;">
                  <label for="embadedCode"><h5>ادخل رابط الفديو :</h5></label>
                  <input type="text" class="form-control" id="embadedCode" name="embadedCode_src" placeholder="رابط الفديو">
                </div>


                <div class="form-group">
                  <label for="typeField">المادة الدراسية  :</label>
                  <select class="form-control form-control-select mt-3" id="typeField" name="subject_id">
                    <option selected>-- اختر مادة --</option>
                    @foreach($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}} التابعة لل {{$subject->class->name}}</option>
                    @endforeach
                  </select>
                </div>
                <!--
                <div class="form-group">
                  <label for="attachmentField">اختر الملفات المرفقة المرتبطة بهذا الإختبار :</label>
                  <select multiple class="form-control form-control-select mt-3" id="attachmentField" name="attachments">
                    <option selected>-- اختر المرفقات --</option>
                    @foreach($attachments as $attachment)
                    <option value="{{$attachment->id}}">{{$attachment->name}}</option>
                    @endforeach
                  </select>
                </div> -->
                <div class="radioG">
                  <h5>تفعيل هذا الأختبار :</h5>
                  <div class="radio">
                    <input type="radio" name="active" value="1" checked>
                    <label>مفعل</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" value="0">
                    <label>غير مفعل</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-success myhover">إضافة</button>
                <a href="{{route('test.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
