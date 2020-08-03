<!doctype html>
<html lang="ar">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HLMS</title>
    {{-- <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaijaan&amp;subset=arabic" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('js/slick/slick.css')}}"/>
    <!-- Add the new slick-theme.css if you want the default styling -->
    <link rel="stylesheet" type="text/css" href="{{asset('js/slick/slick-theme.css')}}"/>
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/front-end-styles.css')}}"> --}}
    <link href="https://fonts.googleapis.com/css?family=Changa:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
	<script src="https://www.youtube.com/iframe_api"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{asset('new_design/css/animate.css')}}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{asset('new_design/css/icomoon.css')}}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{asset('new_design/css/bootstrap.css')}}">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('new_design/css/magnific-popup.css')}}">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{asset('new_design/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('new_design/css/owl.theme.default.min.css')}}">

    <!-- Theme style  -->
    <link rel="stylesheet" href="{{asset('new_design/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('new_design/css/custom.css')}}">
    <!-- Modernizr JS -->
    <script src="{{asset('new_design/js/modernizr-2.6.2.min.js')}}"></script>
	<script>
var players = [];
var ch=false;
function onYouTubeIframeAPIReady() {

var predefined_players = document.getElementsByTagName('iframe');

console.log("number of players: " + predefined_players.length);

for(var i = 0; i < predefined_players.length; i++){
predefined_players[i].id = "player" + i;
var ss=predefined_players[i].src;
predefined_players[i].src="http"+ss.substr(5,ss.length)+"&enablejsapi=1";
  players[i] = new YT.Player("player" + i, {
    events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
    }
});
}
}
function onPlayerReady() {
//console.log("on load: ");
// players[1].playVideo();
    }

    function onPlayerStateChange(event) {
        var link = event.target.a.id;
        var newstate = event.data;
		console.log("EEEEEE");
		console.log(link);
//        console.log(link + " has a state:" + newstate);
	if (newstate == YT.PlayerState.PLAYING) {
    players.forEach(function(item, i) {
        if (item.a.id != link) item.pauseVideo();
    });
}
}
</script>

    @yield('styles')

  </head>

  <body>
    <div class="fh5co-loader"></div>

    <div id="page">
        <nav class="fh5co-nav" role="navigation">
            <div class="top">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-right" style="font-family: 'Changa', sans-serif;">
                            <marquee direction="right">مرحباً بكم في مدرستنا الجديدة </marquee>

                        </div>
                    </div>
                </div>
            </div>
            <div class="top-menu">
                <div class="container">
                    <div class="row nav-row">

                        <div class="col-xs-10  menu-1" style="height:125px; padding-right: 50px;">
                            <ul>
                                <li><a href="/">الرئيسية</a></li>
                                <li class="has-dropdown">
                                  <a href="#">الصفوف</a>
                                  <ul class="dropdown" style="width:200px; text-align: right; direction: rtl">
                                    @foreach($classes as $class)
                                      <li>
                                      @if ( $class->free == 0 )
                                        <a href="#"> {{$class->name}}</a>
                                      @else
                                        <a href="{{ route('class.show', $class) }}">     {{$class->name}}  </a>
                                      @endif
                                      </a></li>
                                    @endforeach
                                  </ul>
                              </li>
                                <li class="has-dropdown">
                                    <a href="#">الدورات</a>
                                    <ul class="dropdown" style="width:270px; text-align: right; direction: rtl">
                                      @foreach($courses as $course)
                                      <li><a href="#">
                                     {{$course->title}}

                                      </a> <li>
                                    @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ route('AboutUs') }}">عن المدرسة</a></li>
                                <li><a href="{{ route('contactUs') }}">تواصل معنا</a></li>

                            </ul>
                        </div>

                        <div class="col-xs-2">
                            <div style="background-color:#fff;
												border-radius:50%;width:125px !important;height:125px;">
                                <div id="fh5co-logo"><a href="index.html"><span>
														<img src="{{asset('imgs/logo1.png')}}" style="width:105px !important ;height:115px;"></span></a></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </nav>

    @yield('content')

    <footer id="fh5co-footer" role="contentinfo" style="font-family: 'Changa', sans-serif; padding: 0 0">
        <br>
      <center>
          <div class="container">
              <!--<div class="row">-->

              <!--    <div class="col-md-6">-->
              <!--        <h4 style="direction:rtl; font-family: 'Changa', sans-serif; ">التواصل معنا </h4>-->
              <!--        <ul class="fh5co-footer-links">-->
              <!--            <li><a href="#">الهاتف : 05522568343</a></li>-->
              <!--            <li><a href="#">turkeyhome.rim@gmail.com</a></li>-->

              <!--        </ul>-->
              <!--    </div>-->



              <!--    <div class="col-md-3" style="direction:rtl;">-->

              <!--      <p>-->
              <!--          <ul class="fh5co-social-icons">-->
              <!--              <li><a href="#"><i class="icon-twitter"></i></a></li>-->
              <!--              <li><a href="#"><i class="icon-facebook"></i></a></li>-->
              <!--              <li><a href="#"><i class="icon-linkedin"></i></a></li>-->
              <!--              <li><a href="#"><i class="icon-dribbble"></i></a></li>-->
              <!--          </ul>-->
              <!--      </p>-->
              <!--    </div>-->
              <!--</div>-->
            <br>
              <div class="row copyright" style="font-family: 'Changa', sans-serif;">
                   <div>
                  حقوق النشر © 2019 - كافة الحقوق محفوظة - تركي هوم.
<br>
               Designed By <a href="https://www.facebook.com/4K-Company-335927173999246" target="_blank">4K Company.</a></div>
              </div>

          </div>
      </center>
  </footer>
</div>

<div class="gototop js-top">
  <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="{{asset('new_design/js/jquery.min.js')}}"></script>
<!-- jQuery Easing -->
<script src="{{asset('new_design/js/jquery.easing.1.3.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('new_design/js/bootstrap.min.js')}}"></script>
<!-- Waypoints -->
<script src="{{asset('new_design/js/jquery.waypoints.min.js')}}"></script>
<!-- Stellar Parallax -->
<script src="{{asset('new_design/js/jquery.stellar.min.js')}}"></script>
<!-- Carousel -->
<script src="{{asset('new_design/js/owl.carousel.min.js')}}"></script>
<!-- countTo -->
<script src="{{asset('new_design/js/jquery.countTo.js')}}"></script>
<!-- Magnific Popup -->
<script src="{{asset('new_design/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('new_design/js/magnific-popup-options.js')}}"></script>
<!-- Main -->
<script src="{{asset('new_design/js/main.js')}}"></script>

<script>
  $('.our-courses').owlCarousel({
      rtl: true,
      loop: true,
      margin: 10,
      nav: true,
      autoplay: false,
      responsive: {
          0: {
              items: 1
          },
          600: {
              items: 2
          },
          1000: {
              items: 3
          }
      }

  });
  $(".owl-next").html("التالي");
  $(".owl-prev").html("السابق");
</script>
<script>
  $('.student').owlCarousel({
      rtl: true,
      loop: true,
      margin: 10,
      autoplay: true,
      nav: true,
      responsive: {
          0: {
              items: 1
          },
          600: {
              items: 2
          },
          1000: {
              items: 3
          }
      }
  });
  $(".owl-next").html("التالي");
  $(".owl-prev").html("السابق");
</script>


{{--
    <!-- jQuery (Bootstrap JS plugins depend on it) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{asset('js/slick/slick.min.js')}}"></script>
    <script src="{{asset('js/front-end-script.js')}}"></script> --}}

    @yield('scripts')


  </body>
</html>
