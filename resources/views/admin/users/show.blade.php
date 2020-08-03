@extends('admin.layouts.master')



@section('content')



<div id ="content">



    <div id="table" class="row" >

        <div class="col-lg-12 col-md-12 col-sm-12 ">

            <div class="card">

                <div class="card-header" style="text-align: right; font-size: x-large;">{{ __('معلومات المستخدم') }}</div>



                <div class="card-body">

                    



                        <div class= "row ">

                            <h2> اسم المستخدم:{{$user->username}}</h2>

                        </div>



                        <div class= "row">

                            <h2>رقم الكملك:{{$user->tc}}</h2>

                        </div>



                        <div class= "row">

                            <h2>رقم الهاتف:{{$user->phone}}</h2>

                        </div>



                        <div class= "row">

                        @if($user->hasRole(0))

                            <h2>نوع المستخدم:مدير نظام</h2>

                            @elseif($user->hasRole(1))

                            <h2>نوع المستخدم:مشرف </h2>

                            @elseif($user->hasRole(2))

                            <h2>نوع المستخدم:مدرس </h2>

                            @elseif($user->hasRole(3))

                            <h2>نوع المستخدم:طالب </h2>

                            @endif

                        </div>



                        

                </div>

            </div>

        </div>

    </div>



    @if ($user->hasAnyRole([2,3]))

    <div id="table" class="row">

        <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="card table-cards color-grey">

            <div class="card-body">

            <div class="content-header">

                <h2>
                @if($user->hasRole(3))
                    <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الصفوف المرتبط بها</small>
                @else
                    <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> المواد المرتبط بها</small>
                @endif
                </h2>

            </div>

            <table class="table table-bordered table-hover table-width">

                <thead>

                <tr>
                    @if($user->hasRole(3))
                        <th>اسم الصف</th>
                    @else
                        <th>اسم المادة</th>
                    @endif

                    @if($user->hasRole(3))
                        <th>فصل المستخدم عن الصف</th>
                    @else
                        <th>فصل المدرس عن المادة</th>
                    @endif

                </tr>

                </thead>

                <tbody>



                @if($user->hasRole(3))

                @foreach($user->classess as $class)

                <tr>

                    <td>{{$class->name}}</td>

                    <td>

                    

                    <div class="operations delete">

                        

                        <form action="{{ route('class.deletestudent',['class' => $class->id]) }}" method="POST" id="deleteForm">

                        {!! csrf_field() !!}

                        

                        <input type="hidden" name="student_id" value="{{$user->id}}">     

                        <input type="submit" class="btn btn-danger" value ="فصل">

                        </form> 

                         

                             

                        

                    </div>

                    </td>

                </tr>

                @endforeach

                @elseif($user->hasRole(2))

                @foreach($user->subjects as $class)

                <tr>

                    <td>{{$class->name}} التابعة لـ {{$class->class->name}}</td>

                    <td>

                    

                    <div class="operations delete">



                    <form action="{{ route('subject.deleteteacher',['subject' => $class->id]) }}" method="POST" id="deleteForm">

                        {!! csrf_field() !!}

                        

                        <input type="hidden" name="teacher_id" value="{{$user->id}}">    

                        <input type="submit" class="btn btn-danger" value ="فصل">

                        </form>
                    </div>
                        @endforeach

                @endif

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

                <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدورات المرتبط بها</small>

                </h2>

            </div>

            <table class="table table-bordered table-hover table-width">

                <thead>

                <tr> 

                    <th>اسم الدورة</th>

                    

                    <th>فصل المستخدم عن الدورة</th>

                </tr>

                </thead>

                <tbody>

                @if($user->hasRole(2))

                @foreach($user->courses as $course)

                <tr>

                    <td>{{$course->title}}</td>

                    

                    

                    <td>

                    <div class="operations delete">

                         

                        <form action="{{ route('course.deleteteacher',['course' => $course->id]) }}" method="POST" id="deleteForm">

                        {!! csrf_field() !!}

                        

                        <input type="hidden" name="teacher_id" value="{{$user->id}}">    

                        <input type="submit" class="btn btn-danger" value ="فصل">

                        </form>     

                        

                    </div>

                    </td>

                </tr>

                @endforeach

                @else

                @foreach($user->coursess as $course)

                <tr>

                    <td>{{$course->title}}</td>

                    

                    

                    <td>

                    <div class="operations delete">

                         

                        <form action="{{ route('course.deletestudent',['course' => $course->id]) }}" method="POST" id="deleteForm">

                        {!! csrf_field() !!}

                        

                        <input type="hidden" name="student_id" value="{{$user->id}}">    

                        <input type="submit" class="btn btn-danger" value ="فصل">

                        </form>     

                        

                    </div>

                    </td>

                </tr>

                @endforeach

                @endif

                </tbody>

            </table>

            </div>

        </div>

        </div>

    </div>



    @endif


    @if($user->hasAnyRole([3]))
    <div id="table" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card table-card color-grey">
                <div class="card-header" style="text-align: right">
                    اضافة الطالب الى الصف :
                </div>

                <div class="card-body">
                    <form  method="post" action="{{route('class.addstudent',['sid'=>$user->id])}}">
                        @csrf
                        <label for="class_id">الصف :</label>
                        <input type="hidden" name="sid" value="{{$user->id}}" />
                        <select id="class_id" class="form-control form-control-select" name="cid">
                            @foreach(\App\ClassRoom::all()->sortBy('order_num') as $class)
                                <option value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                        <input class="btn btn-primary" value="اضافة" type="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="table" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card table-card color-grey">
                <div class="card-header" style="text-align: right">
                    اضافة الطالب الى دورة :
                </div>

                <div class="card-body">
                    <form  method="post" action="{{route('course.addstudent',['sid'=>$user->id])}}">
                        @csrf
                        <label for="class_id">الدورة :</label>
                        <input type="hidden" name="sid" value="{{$user->id}}" />
                        <select id="class_id" class="form-control form-control-select" name="cid">
                            @foreach(\App\Course::all()->sortBy('order_num') as $class)
                                <option value="{{$class->id}}">{{$class->title}}</option>
                            @endforeach
                        </select>
                        <input class="btn btn-primary" value="اضافة" type="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endif

@endsection
