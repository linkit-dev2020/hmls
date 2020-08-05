@extends('front-end.nhome.master')

@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=752&q=80); background-position: 20% center" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread" style="font-family: Changa">عن النظام</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="">HLMS <i class="ion-ios-arrow-forward"></i></a></span> <span>الرئيسية <i class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftc-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-5 order-md-last wrap-about py-5 wrap-about bg-light">
                    <div class="text px-4 ftco-animate">
                        <h1 class="mb-4 align-content-center"  style="font-family:Changa; text-align: center">أهلا بكم في نظام التعلم الالكتروني</h1>
                        <p style="text-align: center;direction: rtl">
                            يتألف نظام التعلم الالكتروني من عدد كبير من الوحدات التي يمكن للطلاب الاستفادة منها
                        </p>
                    </div>
                </div>
                <div class="col-md-7 wrap-about py-5 pr-md-4 ftco-animate">
                    <h1 class="mb-4" style="text-align:center;font-family:ae_AlYermook">بماذا نتميز</h1>
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="flaticon-reading"></span></div>
                                <div class="text" style="text-align: right;font-family:ae_AlYermook">
                                    <h3>المنصة الأولى التي تقدم دورات داعمة</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="flaticon-security"> </span></div>
                                <div class="text"  style="text-align: right;font-family:ae_AlYermook">
                                    <h3>منصة متكاملة داعمة لعملية التعليم بدورات تخصصية</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="flaticon-jigsaw"></span></div>
                                <div class="text" style="text-align: right;font-family:ae_AlYermook" >
                                    <h3>تقنيات عالية في طرح المنهاج بشكل مختصر</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="flaticon-education"></span></div>
                                <div class="text" style="text-align: right;font-family:ae_AlYermook">
                                    <h3>خبرة كبيرة في تعليم كافة المواد ومناهجها و طرائق التدريس فيها
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-gallery">
        <div class="container-wrap">
            <div class="row no-gutters">
                <div class="col-md-3 ftco-animate">
                    <a href="{{asset('images/image_1.jpg')}}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{asset('images/course-1.jpg')}});">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="{{asset('images/image_2.jpg')}}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{asset('images/image_2.jpg')}});">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="{{asset('images/image_3.jpg')}}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{asset('images/image_3.jpg')}});">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="{{asset('images/image_4.jpg')}}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{asset('images/image_4.jpg')}});">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('navscript')
    $("#about").addClass("active");
@endsection
