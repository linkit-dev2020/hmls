@extends('admin.layouts.master')

@section('content')

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الأختبارات </small></h1>
        </div>
      </div>
        @if(Auth::user()->hasAnyRole([0,1,2]))
      <div class="col-lg-2">
        @if(!$test->active)
        <form action="{{ route('test.activate', $test) }}" method="POST" id="maketestActivate" style="display:inline; margin-right:10px;">
          {!! csrf_field() !!}
          <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('maketestActivate').submit();"> اجعل الإختبار مفعل </a>
          </form>
          @else
          <form action="{{ route('test.deactivate', $test) }}" method="POST" id="maketestDeactivate" style="display:inline; margin-right:10px;">
            {!! csrf_field() !!}
            <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('maketestDeactivate').submit();"> اجعل الإختبار غير مفعل</a>
        </form>
        @endif
      </div>
        @endif

      <div class="col-lg-6">
        <a href="{{ URL::previous() }}" class="btn btn-primary button-margin-header custom-but pull-left" >العودة
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div>
    </div>
  </div>

    @if (  $test->type == "video" || $test->type == "audio" )
    <div id="table" class="row">
        <div class="col-lg-6">
            <div class="card table-cards color-grey">
                <div class="card-body">
                    <div class="content-header">
                        <h2>
                            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>ملف الاختبار </small>
                        </h2>
                    </div>
                    @if (  $test->type == "video")
                        {{--<video width="320" height="240" controls>--}}
                        {{--<source src= {!! $advice->src !!} type="video/mp4">--}}
                        {{--<source src= {!! $advice->src !!}  type="video/ogg">--}}
                        {{--Your browser does not support the video tag.--}}
                        {{--</video>--}}
                    {!! $test->src !!}
                    @elseif( $advice->type == "audio")

                        <audio controls>
                            <source src= {!! $test->src !!} type="audio/ogg">
                            <source src= {!! $test->src !!} type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>

                    @endif


                </div>
            </div>
        </div>
    </div>
    @endif


    <div id="table" class="row">
    <div class="col-lg-10 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">

          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> معلومات الإختبار</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>عنوان الإختبار</th>
                @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                <th>التفعيل</th>
                @endif
                <th>الفصل</th>
                  <th>المادة</th>
                <th class="go-m">نوع الملف</th>
                <th>رابط الإختبار</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               <td>{{$test->title}}</td>
                  @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
               <td>
               @if($test->active)
                  <form action="{{ route('test.deactivate', $test) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$test->id+1}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$test->id+1}}').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form>
                  @else
                  <form action="{{ route('test.activate', $test) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$test->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$test->id}}').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  @endif
               </td>
                  @endif
               <td>{{$test->term}}</td>
                  <td>{{$subjects[0]->name }}</td>
               <td class="go-m">{{$test->type}}</td>
               <td><a href="/storage/{{str_replace('public/','',$test->src)}}">تحميل </a></td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
  <div id="table" class="row">
        <div class="col-lg-10 col-m-u">
          <div class="card table-cards color-grey">
            <div class="card-body">

              <div class="content-header">
                <h2>
                  <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>المرفقات</small>
                </h2>
              </div>
              <table class="table table-bordered table-hover table-width">
                        <thead>
                                <tr>
                                  <th>اسم الملف</th>
                                  <th>النوع</th>
                                  <th>نوع التبعية</th>
                                  <th>عرض</th>
                                  <th>تعديل</th>
                                  <th>حذف</th>
                                </tr>
                            </thead>
                              <tbody>
                                @foreach($test->attachments()->get() as $attachment)
                                <tr>
                                  <td>{{ $attachment->name }}</td>
                                  @if($attachment->type === 'file')
                                  <td>ملف</td>
                                  @elseif($attachment->type === 'image')
                                  <td>صورة</td>
                                  @else
                                    <td></td>
                                  @endif
                                  @if($attachment->attachmentable_type === 'App\Lesson')
                                  <td>لدرس</td>
                                  @elseif($attachment->attachmentable_type === 'App\Deneme')
                                  <td>لدينيمي</td>
                                  @elseif($attachment->attachmentable_type === 'App\Test' || $attachment->attachmentable_type === 'App\test')
                                  <td>للأختبار</td>
                                    @else
                                    <td></td>
                                  @endif
                                  <td>
                                    <div class="operations update">
                                      <a href="{{ route('attachment.show', $attachment) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="operations update">
                                      <a href="{{ route('attachment.edit', $attachment) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="operations delete">
                                      <form action="{{ route('attachment.destroy',$attachment) }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button id="{{$attachment->id}}" class=" btn-xs delete-button" style="display:none;">
                                          <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                        </button>
                                        <a herf="javascript:;" onclick="$('#{{$attachment->id}}').click();" >
                                          <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                        </a>
                                      </form>
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>


    @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
    <div id="table" class="row">
        <div class="card-deck">
            <div class="col-lg-6">
                <div class="card color-grey">
                    <div class="card-body">
                        <div class="card-header">إضافة مرفق</div>

                        <form action="{{route('attachment.store')}}" enctype="multipart/form-data" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="namne"><h5>اسم المرفق :</h5></label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="اسم المرفق الجديد">
                            </div>
                            <div class="form-group" >
                                <label for="attachmentable_typeField">مرتبط مع :</label>
                                <select   class="form-control form-control-select mt-3" id="attachmentable_typeField" name="attachmentable_type">
                                    <option  selected value="App\test">اختبار</option>

                                </select>
                            </div>
                            <div class="form-group" >
                                <label for="attachmentable_idField">تابع ل :</label>
                                <select  class="form-control form-control-select mt-3" id="attachmentable_idField"
                                         name="attachmentable_id" >
                                    <option selected value="{{$test->id}}">{{$test->title}}</option>
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
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

  <!-- <div id="table" class="row">
    <div class="col-lg-6">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> مرفقات الإختبار</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
          <thead>
              <tr>
                <th>اسم الملف</th>
                <th>النوع</th>
              </tr>
            </thead>
            <tbody>
              @foreach($attachments as $attachment)
              <tr>
                <td>{{ $attachment->name }}</td>
                @if($attachment->type === 'file')
                <td>ملف</td>
                @elseif($attachment->type === 'image')
                <td>صورة</td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>

          <form action="{{ route('test.addattachment', $test) }}" method="POST"  style="display:inline; margin-right:10px;">
            {!! csrf_field() !!}
                <div class="form-group">
                  <label for="attachment">أضف مرفق إلى الإختبار :</label>
                  <select class="form-control form-control-select mt-3" id="attachment" name="attachment_id">
                    <option selected>-- اختر مرفق --</option>
                    @foreach($allAttachments as $aattachment)
                    <option value="{{$aattachment->id}}">{{$aattachment->name}}</option>
                    @endforeach
                  </select>
                </div>
            <input type="submit" class="btn btn-success myhover" value="اضافة مرفق">
        </form>


        </div>
      </div>
    </div>
  </div> -->



</div>
@endsection
