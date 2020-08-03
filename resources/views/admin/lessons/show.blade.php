@extends('admin.layouts.master')

@section('content')

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدروس </small></h1>
        </div>
      </div>

      @if(Auth::user()->hasAnyRole([0,1,2]))
      <div class="col-lg-2">
        @if(!$lesson->active)
        <form action="{{ route('lesson.activate', $lesson) }}" method="POST" id="makelessonActivate" style="display:inline; margin-right:10px;">
          {!! csrf_field() !!}
          <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makelessonActivate').submit();"> اجعل الدرس مفعل </a>
          </form>
          @else
          <form action="{{ route('lesson.deactivate', $lesson) }}" method="POST" id="makelessonDeactivate" style="display:inline; margin-right:10px;">
            {!! csrf_field() !!}
            <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makelessonDeactivate').submit();"> اجعل الدرس غير مفعل</a>
        </form>
        @endif
      </div>
        <div class="col-lg-6">
          <a href="{{route('lesson.index')}}" class="btn btn-primary button-margin-header custom-but pull-left" >العودة
            <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
          </a>
        </div>
       @endif ;
      @if(Auth::user()->hasAnyRole([3]))
      <div class="col-lg-6">
        <a href="javascript:history.back()" class="btn btn-primary button-margin-header custom-but pull-left" >العودة
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div>
        @endif
    </div>
  </div>

  @if($lesson->type === 'video')
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> فيديو الدرس</small>
            </h2>
          </div>

          <!-- <video width="520" height="440" controls>
            <source src="{{$lesson->src}}" type="video/mp4">
          Your browser does not support the video tag.
          </video> -->

          {!! $lesson->src !!}

        </div>
      </div>
    </div>
  </div>
  @endif

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> معلومات الدرس</small>
            </h2>
          </div>

          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>اسم الدرس</th>
                @if(Auth::user()->hasAnyRole([0,1,2]))
                <th>التفعيل</th>
                @endif
                <th>المقدمة</th>
                @if($lesson->type === 'image' || $lesson->type === 'pdf' || $lesson->type === 'word')
                <th>رابط الدرس</th>
                @elseif($lesson->type === 'url')
                <th>عنوان موقع الفيديو</th>
                @endif
                @if (Auth::user()->hasRole(3))<th>تقيم الدرس</th>@endif
              </tr>
            </thead>
            <tbody>
              <tr>
               <td>{{$lesson->title}}</td>
                @if(Auth::user()->hasAnyRole([0,1,2]))
               <td>
               @if($lesson->active)
                  <form action="{{ route('lesson.deactivate', $lesson) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$lesson->id+1}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$lesson->id+1}}').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form>
                  @else
                  <form action="{{ route('lesson.activate', $lesson) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$lesson->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$lesson->id}}').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  @endif
               </td>
                @endif
               <td>{{$lesson->intro}}</td>
               @if($lesson->type === 'image' || $lesson->type === 'pdf' || $lesson->type === 'word')
               <td><a href="{{$lesson->src}}">تحميل الدرس</a></td>
               @elseif($lesson->type === 'url')
               <td><a href="{{$lesson->src}} " target="_blank">الأنتقال إلى موقع الدرس </a></td>
               @endif
               @if (Auth::user()->hasRole(3))
               <td>
                @if($studentEvaluation === null)
                <form action="{{route('evaluation.store', $lesson)}}" method="POST">
                      {!! csrf_field() !!}
                  <div class="rate">
                    <input type="radio" id="star5" name="value" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="value" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="value" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="value" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="value" value="1" />
                    <label for="star1" title="text">1 star</label>
                    <input type="hidden" id="lesson_id" name="lesson_id" value="{{$lesson->id}}" />
                    <input type="hidden" id="lesson_id" name="student_id" value="{{Auth::user()->id}}" />
                    <button class="btn btn-sm btn-success">تأكيد</button>
                  </div>
                </form>
                @elseif($studentEvaluation != null)
                <form action="{{route('evaluation.update', $studentEvaluation)}}" method="POST">
                      {!! csrf_field() !!}
                  <div class="rate">
                    <input type="radio" id="star5" name="value" value="5" {{ $studentEvaluation->value === 5 ? 'checked' : '' }} />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="value" value="4" {{ $studentEvaluation->value === 4 ? 'checked' : '' }} />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="value" value="3" {{ $studentEvaluation->value === 3 ? 'checked' : '' }} />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="value" value="2" {{ $studentEvaluation->value === 2 ? 'checked' : '' }} />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="value" value="1" {{ $studentEvaluation->value === 1 ? 'checked' : '' }} />
                    <label for="star1" title="text">1 star</label>
                    <button class="btn btn-sm btn-success">تأكيد</button>
                  </div>
                </form>
                @endif
              </td>
              @endif
              </tr>
            </tbody>
          </table>

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
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>تعليقات الدرس</small>
            </h2>
          </div>
			<div id="w" dir="rtl">
			<div id="container">
			  <ul id="comments">
						@foreach($comments as $comment)
                            @if(!isset($comment->commenter)) @continue
                            @endif
						@if($comment->parent>0) @continue
						@endif
						<li class="cmmnt">
						  <div class="avatar"><a href="javascript:void(0);">
							@if($comment->commenter_type=="admin")
								<img src="{{Storage::url('avatars/admin.png')}}" width="55" height="55" alt="">
							@endif
							@if($comment->commenter_type=="student")
								<img src="{{Storage::url('avatars/user.png')}}" width="55" height="55" alt="">
							@endif
							@if($comment->commenter_type=="teacher")
								<img src="{{Storage::url('avatars/teacher.png')}}" width="55" height="55" alt="">
							@endif
							@if($comment->commenter_type=="manager")
								<img src="{{Storage::url('avatars/manager.png')}}" width="55" height="55" alt="">
							@endif
						  </a></div>
						  <div class="cmmnt-content">
							<header style="text-align:left!important">
								<a href="javascript:void(0);" class="userlink">{{$comment->commenter->username}}</a>
							</header>
							<p>{{$comment->content}}</p>
							@if($comment->commenter_id === Auth::user()->id || Auth::user()->hasAnyRole([0,1]))
								<div class="operations delete" style="position:absolute!important;top:7%;right:5px;">
								<form class="form-inline" action="{{ route('comment.destroy',['comment' => $comment->id]) }}" method="POST" id="deleteForm">
								   {!! csrf_field() !!}
								  <input type="hidden" name="_method" Value="delete">
								  <input type="submit" class="btn btn-danger" value="X">
								</form>
							  </div>
						    @endif
						  </div>

						  <ul class="replies">
							@foreach($comment->childs as $rep)
                                @if($rep->commenter==null) @continue;
                                @endif
							<li class="cmmnt">
							  <div class="avatar"><a href="javascript:void(0);">
								@if($rep->commenter_type=="admin")
									<img src="{{Storage::url('avatars/admin.png')}}" width="55" height="55" alt="">
								@endif
								@if($rep->commenter_type=="student")
									<img src="{{Storage::url('avatars/user.png')}}" width="55" height="55" alt="">
								@endif
								@if($rep->commenter_type=="teacher")
									<img src="{{Storage::url('avatars/teacher.png')}}" width="55" height="55" alt="">
								@endif
								@if($rep->commenter_type=="manager")
									<img src="{{Storage::url('avatars/manager.png')}}" width="55" height="55" alt="">
								@endif
							  </a></div>
							  <div class="cmmnt-content">
								<header style="text-align:left!important">
									<a href="javascript:void(0);" class="userlink">{{$rep->commenter->username}}</a>
								</header>
								<p>{{$rep->content}}</p>
								@if($rep->commenter_id === Auth::user()->id || Auth::user()->hasAnyRole([0,1]))
									<div class="operations delete" style="position:absolute!important;top:7%;right:5px;">
									<form action="{{ route('comment.destroy',['comment' => $comment->id]) }}" method="POST" id="deleteForm">
									   {!! csrf_field() !!}
									  <input type="hidden" name="_method" Value="delete">
									  <input type="submit" class="btn btn-danger" value="x" style="font-size:10px;">
									</form>
								  </div>
								@endif
							  </div>
							</li>
							@endforeach
						  </ul>

						  <form action="{{ route('lesson.addcomment', $lesson) }}" class="form-inline" method="POST"  style="display:inline; margin-right:10px;">
							{!! csrf_field() !!}
							<div class="form-group">
								<input class="form-control" type="text" size="40" name="content"/>
								<input type="hidden" name="commid" value="{{$comment->id}}" />
							</div>
							<input type="submit" class="btn btn-success " value="رد"/>
						   </form>

						</li>
						@endforeach
			  </ul>
			</div>
		  </div>
          <form action="{{ route('lesson.addcomment', $lesson) }}" method="POST"  style="display:inline; margin-right:10px;">
            {!! csrf_field() !!}
            <div class="form-group">
            <label for="comment"> اضافة تعليق</label>
            <input class="form-control" type="text" name="content">
            <input type="hidden" name="commid" value="0">
            </div>
            <input type="submit" class="btn btn-success myhover" value="اضافة تعليق">
        </form>


        </div>
      </div>
    </div>

  </div>

  @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>تقيم الدرس من قبل الطلاب</small>
            </h2>
          </div>

          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>الطالب</th>
                <th>التقيم</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ratings as $rating)
              <tr>
               <td>{{$rating->student->full_name}}</td>
               <td>
                <div class="rating">
                  @for($i =0; $i < $rating->value; $i++)
                  <span class="fa fa-star checked"></span>
                  @endfor
                  @for($i =$rating->value; $i < 5; $i++)
                  <span class="fa fa-star"></span>
                  @endfor
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
  @endif

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>مدرسوا الدرس</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>اسم المدرس</th>
                @if(Auth::user()->hasAnyRole([0,1]))
                <th>حذف</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($teachersLesson as $teacherLesson)
              <tr>
                <td>{{$teacherLesson->username}}</td>


                @if(Auth::user()->hasAnyRole([0,1]))
                <td>
                  <div class="operations delete">
                    <form action="{{ route('lesson.deleteteacher',['lesson' => $lesson->id, 'teacher_id'=>$teacherLesson->id]) }}" method="POST" id="deleteForm">
                       {!! csrf_field() !!}

                      <button id="{{$lesson->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#{{$lesson->id}}').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </a>
                    </form>
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  @if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) )
  <div id="table2" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> إضافة مدرس لهذا الدرس</small>
            </h2>
          </div>

          <form action="{{route('lesson.addteacher',$lesson)}}" method="POST">
            {!! csrf_field() !!}
            <div class="form-group">
              <label for="addteacher">اختر مدرس لاضافته الى هذا الدرس :</label>
              <select class="form-control form-control-select mt-3" id="addteacher" name="teacher">
                <option selected>-- اختر مدّرس --</option>
                @foreach($teachers as $teacher)
                <option value="{{$teacher->id}}">{{$teacher->username}}</option>
                @endforeach
              </select>
            </div>
            <input type="submit" class="btn btn-success button1" value="اضافة المدرس">
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif

  <div id="table" class="row">
    <div class="card-deck">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card color-gray">
                <div class="card-body">
                    <div class="card-header">
                        المرفقات
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
                              @foreach($attachments as $attachment)
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
              <div class="form-group" >
                <label for="attachmentable_typeField">مرتبط مع :</label>
                <select   class="form-control form-control-select mt-3" id="attachmentable_typeField" name="attachmentable_type">
                  <option selected value="App\Lesson">درس</option>
                </select>
              </div>
              <div class="form-group" >
                <label for="attachmentable_idField">تابع ل :</label>
                <select  class="form-control form-control-select mt-3" id="attachmentable_idField"
                        name="attachmentable_id" >
                  <option selected value="{{$lesson->id}}">{{$lesson->title}}</option>
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
</div>

@endsection
