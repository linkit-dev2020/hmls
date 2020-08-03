@extends('admin.layouts.master')
@section('content')
    <div id="content">
        <div class="header-card table-cards color-grey">
            <div class="row">
                <div class="col-lg-4">
                    <div class="content-header">
                        <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المرفقات </small></h1>
                    </div>
                </div>
                <div class="col-lg-6">
                <a href="{{route('attachment.index')}}" class="btn btn-primary button-margin-header custom-but pull-left" >العودة
                    <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
                </a>
                </div>
            </div>
        </div>
        <div id="table" class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card table-cards color-grey">
                    <div class="card-body">
                        <div class="content-header">
                            <h2>              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> معلومات المرفق </small>            </h2>
                        </div>
                        <div>
                            <table class="table table-bordered">
                                <tr>cd
                                    <td>الاسم</td>
                                    <td>{{$attachment->name}}</td>
                                </tr>

                                <tr>
                                    <td>النوع</td>
                                    <td>{{$attachment->type}}</td>
                                </tr>

                                <tr>
                                    <td>مرتبط مع</td>
                                    <td>
                                        @if($attachment->attachmentable_type=='App\Lesson')
                                            درس
                                        @elseif($attachment->attachmentable_type=='App\Deneme')
                                            دينيمي
                                        @elseif($attachment->attachmentable_type=='App\Test')
                                            اختبار
                                        @elseif($attachment->attachmentable_type=='App\test')
                                            اختبار
                                        @else
                                            -

                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>ملف المرفق</td>
                                    <td>
                                        @if($attachment->type=='image')
                                            <img src="{{$attachment->src}}"  />
                                        @elseif($attachment->type=='video')
                                            {!! $attachment->src !!}
                                        @else
                                            <a class="btn btn-primary" target="_blank" href="{{asset($attachment->src)}}" >فتح المرفق</a>
                                        @endif
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
