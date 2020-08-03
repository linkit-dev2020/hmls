@extends('admin.layouts.master')

@section('content')



    <div id="content">

        <div class="header-card table-cards color-grey">
            <div class="row">
                <div class="col-lg-4">
                    <div class="content-header">
                        <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> احصائيات الطلبات</small></h1>
                    </div>
                </div>

            </div>
        </div>

        <div id="table" class="row">
            <div class="col-lg-8">
                <div class="card table-cards color-grey">
                    <div class="card-body">
                        <div class="content-header">
                            <h2>
                                <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> طلبات الصفوف</small>
                            </h2>
                        </div>
                        <table class="table table-bordered table-hover table-width">
                            <thead>
                            <tr>
                                <th>اسم الطالب </th>
                                <th>اسم الصف</th>
                                <th>تاريخ القبول</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requestsClasses as $request)
                                <tr>
                                    <td>{{$request->student->username}}</td>

                                    <td>{{$request->class->name}}</td>
                                    <td>{{$request->updated_at}}</td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="table" class="row">
            <div class="col-lg-8">
                <div class="card table-cards color-grey">
                    <div class="card-body">
                        <div class="content-header">
                            <h2>
                                <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> طلبات الدورات</small>
                            </h2>
                        </div>
                        <table class="table table-bordered table-hover table-width">
                            <thead>
                            <tr>
                                <th>اسم الطالب </th>
                                <th>اسم الدورة</th>
                                <th>تاريخ القبول</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requestsCourses as $request)
                                <tr>
                                    <td>{{$request->student->username}}</td>

                                    <td>{{$request->course->title}}</td>

                                    <td>{{$request->updated_at}}</td>


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