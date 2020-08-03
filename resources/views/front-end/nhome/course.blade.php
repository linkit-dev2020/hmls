@extends('front-end.nhome.master')

@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=752&q=80); background-position: 20% center" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread" style="font-family: Changa">دوراتنا</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="">دورات <i class="ion-ios-arrow-forward"></i></a></span> <span>الرئيسية <i class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section" style="direction:rtl!important;font-family: Changa">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                </div>
            </div>
            <div class="row" dir="rtl">
            <?php
            $arr=["btn-primary","btn-secondary","btn-tertiary","btn-quarternary"];
            $i=0;

            $a=0;
            ?>
            <!-- Course begin -->
                @foreach($courses as $course)
                    <?php
                    $bgs=["bg_1.jpg","bg_2.jpg","bg_3.jpg","bg_4.jpg","bg_5.jpg","bg_11.jpg","bg_33.jpg"];
                    $url="images/".$bgs[$a%7];
                    $a++;
                    ?>
                    <div class="col-md-6 col-lg-3 ftco-animate" style="margin-top:10px;">
                        <div class="pricing-entry bg-light pb-4 text-center">
                            <div style="height: 200px;">
                                <span class="badge badge-pill" style="font-size: medium"><i class="fa fa-user"></i> {{$course->stunum}}</span>
                                <p><span class="price">{{$course->title}}</span> </p>
                            </div>
                            <div class="img" style="background-image: url({{asset($url)}});"></div>
                            <div class="px-4">
                            </div>
                        </div>
                    </div>
                    <!-- end of course -->
                @endforeach

            </div>
        </div>
    </section>

@endsection
@section('navscript')
    $("#course").addClass("active");
@endsection
