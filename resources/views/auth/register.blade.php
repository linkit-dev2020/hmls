@extends('front-end.nhome.master')

@section('content')
    <style>
        label{
            color:red!important;
        }
        .form-control{
            height: calc(2.25rem + 2px)!important;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-right: 5px!important;
        }
    </style>
    <section class="ftco-section ftco-consult ftco-no-pt ftco-no-pb"  style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=752&q=80); background-position: 0% center;font-family: Changa;background-size: cover">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6 py-5 px-md-5 ">
                <div class="heading-section heading-section-white ftco-animate mb-5">
                    <h2 class="mb-4" style="text-align: center ;">تسجيل طالب جديد</h2>
                </div>
                <form action="{{route('register')}}" method="POST" class="ftco-animate" style="text-align: right;direction: rtl;">
                    @csrf
                    @if ($errors->has('username'))
                        <label for="">{{ $errors->first('username') }}</label><br>
                    @endif
                    <div class="d-md-flex">
                        <div class="form-group">

                            <input type="text" class="form-control" name="username" required placeholder="اسم المستخدم">

                        </div><br>
                    </div>
                    @if ($errors->has('tc'))
                        <label for="">{{ $errors->first('tc') }}</label><br>
                    @endif
                    <div class="d-md-flex">
                        <div class="form-group ml-md-4">
                            <input type="text" class="form-control" name="tc" required placeholder="البريد الالكتروني">
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <label for="">{{ $errors->first('password') }}</label><br>
                    @endif
                    <div class="d-md-flex">
                        <div class="form-group ml-md-4">
                            <input type="password" class="form-control" name="password"  required placeholder=" كلمة المرور">

                        </div><br>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <label for="">{{ $errors->first('password_confirmation') }}</label><br>
                    @endif
                    <div class="d-md-flex">
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation" required placeholder="إعادة كلمة المرور">
                        </div><br>

                    </div>
                    @if ($errors->has('phone'))
                        <label for="">{{ $errors->first('phone') }}</label><br>
                    @endif
                    <div class="d-md-flex">
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" required placeholder="الهاتف">
                        </div>

                    </div>
                    <div class="d-md-flex">
                        <div class="form-group ml-md-12">
                            <input type="submit" value="تسجيل" class="btn btn-outline-secondary py-3 px-4" >
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>


@endsection
