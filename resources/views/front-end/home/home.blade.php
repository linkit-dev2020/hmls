@extends('front-end.layouts.master')

@section('content')
<style>
#fh5co-testimonial .testimony-slide figure img {
    width: 70px;
    height: 70px;
    }
</style>
<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url({{asset('new_design/images/bgk.jpg')}}); background-position: 20% center" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="display-t">
                    <div class="display-tc animate-box" data-animate-effect="fadeIn">
                        <h1 style="font-family: 'Changa', sans-serif;">تركي هوم </h1>
                        <h2 style="font-family: 'Changa', sans-serif;"> المدرسة الالكترونية الافضل
                            <a href="#" target="_blank"> </a>
                            <br><br>
                            <p><a style="font-family: 'Changa', sans-serif;" class="btn btn-primary btn-lg btn-learn" href="{{ route('login') }}">تسجيل الدخول </a>
                            <a style="font-family: 'Changa', sans-serif;" class="btn btn-primary btn-lg btn-video" href="{{ route('register') }}">طالب جديد   </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="fh5co-project" style="font-family: 'Changa', sans-serif; background-image:url({{asset('new_design/images/animation.jpg')}}); background-position: 50% 0px; padding-top: 3em">
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-8 col-md-offset-2 text-center fh5co-heading" style="margin-bottom: 2em;">
                <h2 style="font-family: 'Changa', sans-serif;"> نماذج من دروسنا </h2>

            </div>
        </div>
    </div>
    <div class="container-fluid proj-bottom" style="direction:rtl; font-family: 'Changa', sans-serif; " style="padding-top: 3em;">


        <div class="owl-carousel owl-theme our-courses carders">
            @foreach($showLessons as $showLesson)
            {{-- $segments = explode('/',$showLesson->src);
            $showLesson->src =array_shift($segments); --}}
            <div class="item">
			<div class="flex-video">
                <a href="#"><iframe src="{!! $showLesson->src !!}" width="340" height="192.09039548023" allowfullscreen="" frameborder="0" sandbox="allow-scripts allow-same-origin allow-presentation" layout="responsive"></iframe>
                    <h3>{{ $showLesson->title }}</h3>
                    <span> </span>
                </a>
				</div>
            </div>
            @endforeach

        </div>
    </div>

</div>

<style>

    .carders .item{
        padding: 9px 0;
        text-align: center;
    }
    
    .carders .item iframe{
        width: 100%;
    }
    
    .carders .item h3{
        margin: 0;
        padding: 8px 0;
    }

    .carders .item a{
        display: block;
        width: 90%;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 5px;
        box-shadow: #000 0 0 2px;
        margin: auto;
        overflow: hidden;
    }
</style>
<!-- our classes -->
	<div id="fh5co-testimonial" class="fh5co-bg-section" style="font-family: 'Changa', sans-serif; background-image:url({{Storage::url('sliderimages/classes01.jpg')}}); background-size: cover;">
		<div class="container">
			<br>
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2 style="font-family: 'Changa', sans-serif;color:#fff">صفوفنا</h2>
				</div>
			</div>
			
			<div class="owl-carousel owl-theme student">
				@foreach($classes as $class)
				<div class="item">
					<div class="testimony-slide active text-center">
						<figure>
							<img style="width: 150px; height: 150px;" src="{{Storage::url('sliderimages/classav.png')}}" alt="user">
						</figure>
						{{-- <span>Jean Doe, via <a href="#" class="twitter">Twitter</a></span> --}}
						<blockquote style="color:#fff;">
							<p>&ldquo;{{ $class->name }}&rdquo;</p>
						</blockquote>
					</div>
				</div>
				@endforeach
			</div>
	<br><br>
		</div>
	</div>

<!-- end of our classes -->




<!-- our courses -->
	<div id="fh5co-testimonial" class="fh5co-bg-section" style="font-family: 'Changa', sans-serif; background-image:url({{Storage::url('sliderimages/courses.jpg')}}); background-size: cover;">	
		<div class="container">
			<br>
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2 style="font-family: 'Changa', sans-serif;color:#fff;">دوراتنا</h2>
				</div>
			</div>
			<div class="owl-carousel owl-theme student">
				@foreach($courses as $course)
				<div class="item">
					<div class="testimony-slide active text-center">
						<figure>
							<img style="width: 150px; height: 150px;" src="{{Storage::url('sliderimages/classav.png')}}" alt="user">
						</figure>
						{{-- <span>Jean Doe, via <a href="#" class="twitter">Twitter</a></span> --}}
						<blockquote style="color:#fff;">
							<p>&ldquo;{{ $course->title }}&rdquo;</p>
						</blockquote>
					</div>
				</div>
				@endforeach
			</div>
	<br><br>
		</div>
	</div>

<!-- end of our courses -->



<div id="fh5co-testimonial" class="fh5co-bg-section" style="font-family: 'Changa', sans-serif; background-image:url({{asset('new_design/images/bg.jpg')}}); background-size: cover;">
    <div class="container">
        <br>
        <div class="row animate-box">
            <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                <h2 style="font-family: 'Changa', sans-serif;">آراء الطلاب</h2>
            </div>
        </div>
        <div class="owl-carousel owl-theme student">
            @foreach($studentThanks as $studentThank)
            <div class="item">
                <div class="testimony-slide active text-center">
                    <figure>
                        <img style="width: 150px; height: 150px;" src="{{ $studentThank->src }}" alt="user">
                    </figure>
                    {{-- <span>Jean Doe, via <a href="#" class="twitter">Twitter</a></span> --}}
                    <blockquote>
                        <p>&ldquo;{{ $studentThank->content }}&rdquo;</p>
                    </blockquote>
                </div>
            </div>
            @endforeach
        </div>
<br><br>
    </div>
</div>




@endsection
