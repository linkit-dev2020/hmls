
<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Lingua project">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{asset('styles/bootstrap4/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.css">
    <link href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/courses.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/courses_responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
    <script>
        new WOW().init();
    </script>
    <style>
        .top_bar{
            background-color:rgb(158,7,7);
            color: #ffffff !important;
        }
        .nav-item{
            margin-right: 10px;
        }
        .badge{
            font-size: 15px;
        }
        .homee{
            position: fixed;
            background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=752&q=80); background-position: 20% center;background-size: cover;-webkit-filter: blur(5px);
            -moz-filter: blur(10px);
            -o-filter: blur(10px);
            -ms-filter: blur(10px);
            filter: blur(10px);
            transition: 1s;
            opacity: 1;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .homee:hover{
             opacity: 1;
            -moz-filter: blur(0px);
            -o-filter: blur(0px);
            -ms-filter: blur(0px);
            filter: blur(0px);
        }
        .home-content{
            -moz-filter: blur(0px);
            -o-filter: blur(0px);
            -ms-filter: blur(0px);
            filter: blur(0px);
        }


    </style>
</head>
<body>

<div class="super_container">

    <!-- Header -->

    <header class="header">

        <!-- Top Bar -->
        <div class="top_bar">
            <div class="top_bar_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="top_bar_content flex-row ">
                                <marquee direction="right" loop="1000"><h3 style="color: #FFFFFF!important;">@yield('marq')</h3></marquee>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Content -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white ftco_navbar ftco-navbar-light" id="ftco-navbar" >
            <div class="container d-flex align-items-center">
                <a class="navbar-brand" href="/"  style="font-size: large;color:rgb(157,8,8)">HLMS
                </a>

                <div class="collapse navbar-collapse" id="ftco-nav" style="vertical-align: middle;line-height: 100%">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a href="/" class="nav-link pl-0" style="font-size: large;color:rgb(157,8,8)">الرئيسية</a></li>
                        @if(Auth::check())
                            <li class="nav-item active"><a href="/stdsh#class" class="nav-link pl-0" style="font-size: large;color:rgb(157,8,8)">الصفوف</a></li>
                            <li class="nav-item active"><a href="/stdsh#courses" class="nav-link pl-0" style="font-size: large;color:rgb(157,8,8)">الدورات</a></li>
                        @else
                            <li class="nav-item active"><a href="/class" class="nav-link pl-0" style="font-size: large;color:rgb(157,8,8)">الصفوف</a></li>
                            <li class="nav-item active"><a href="/courses" class="nav-link pl-0" style="font-size: large;color:rgb(157,8,8)">الدورات</a></li>

                        @endif
                    </ul>
                </div>
                @if(Auth::check())
                <div class="nav navbar-nav navbar-right nav-social">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a href="/stdsh/myclasses" class="nav-link pl-0" style="font-weight: bolder;font-size: large;color:rgb(158,7,7)!important;">صفوفي ودوراتي</a></li>
                        @if(Auth::check())

                            <li class="nav-item">
                                <a class=" nav-link pl-0" href="{{ route('logout') }}" style="font-weight: bolder;font-size: large;color:rgb(158,7,7)!important;"
                                   onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                                    تسجيل الخروج   <span class="fa fa-sign-out" style="color:red;"></span></a>
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </ul>

               </div>
                @endif


                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-caret-down" style="color:red;"></span>
                </button>
            </div>
        </nav>

    </header>

    <!-- Menu -->



    <!-- Home -->

    <div class="" style="height: 700px">
        <div class="homee"></div>
        <div class="breadcrumbs_container">
            <div class="container home-content" >
                <div class="row" >
                    <div class="col text-center wow flip">
                        <h1 class="mb-4 wow flip" style="color:#FFFFFF;"> <h3 style="color:#FFFFFF">نظام التعلم الالكتروني الأفضل</h3></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')
    <!-- Footer -->


    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">

            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        جميع الحقوق محفوظة
                    </p>
                </div>
            </div>
        </div>
    </footer>

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('plugins/easing/easing.js')}}"></script>
<script src="{{asset('js/courses.js')}}"></script>
</body>
</html>
