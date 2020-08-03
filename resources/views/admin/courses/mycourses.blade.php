@extends('admin.layouts.master')

@section('content')
<?php
/**
 * Created by PhpStorm.
 * User: Inspiron
 * Date: 7/20/2019
 * Time: 12:14 PM
 */

?>
<div id=content>
    

    <div id="table" class="row">
        <div class="col-lg-12">
            <div class="card table-cards color-grey">
                <div class="content-header">
                    <h2 style="color: #333;">
                            الدورات الدراسية المنضم اليها
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-width">
                        <thead>
                        <tr>
                            <th>اسم الدورة</th>
                                <th>العرض</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{$course->title}}</td>
                                <td>
                                    <div class="operations show">
                                        <a href="{{ route('course.show', $course) }}">
                                            <i class="fa fa-eye"
                                               style="font-size:18px;color:#5cb85c"></i></a>
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

@endsection