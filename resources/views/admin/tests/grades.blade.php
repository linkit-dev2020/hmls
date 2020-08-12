@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الإختبارات </small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        @if (Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
        <a href="{{route('test.create')}}" class="btn btn-success myhover BP" role="button">إضافة إختبار<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
        @endif
      </div>
    </div>
  </div>

  <div id="table" class="row">
    <div class="col-lg-8 col-m-u">
      <div class="card table-cards color-grey">
        <div class="content-header">
          <h2>
            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الإختبارات</small>
          </h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>اسم الطالب</th>
                <th>الوظيفة</th>
                <th>الملف</th>
                <th>العلامة</th>
              </tr>
            </thead>
            <tbody>
              @foreach($st as $test)
              <tr>
                <td>{{\App\User::find($test->student_id)->full_name}}</td>
                <td>{{\App\Test::find($test->subject_id)->title}}</td>
                <td><a href="{{asset($test->url)}}" target="blank">تحميل</a></td>
                <td>
                    <form action="gradetest" method="POST">
                        @csrf
                        <input type="hidden" name="student_id" value="{{$test->student_id}}">
                        <input type="hidden" name="subject_id" value="{{$test->subject_id}}">
                        <input type="text" name="grade">
                        <input type="submit" class="btn btn-primary" value="تقييم">
                    </form>
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

@endsection
