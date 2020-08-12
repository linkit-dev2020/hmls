<!DOCTYPE html>
<html lang="ar">
<head>
    <title>HLMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Changa:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/open-iconic-bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/animate.css')); ?>">
    <script src="https://www.youtube.com/iframe_api"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.theme.default.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/magnific-popup.css')); ?>">
    <link href="<?php echo e(asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?php echo e(asset('css/aos.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/ionicons.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/icomoon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
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
	<style>
	.owl-carousel .owl-stage, .owl-carousel.owl-drag .owl-item {
		-ms-touch-action: auto;
		touch-action: auto;
	}
    span{
        padding-left: 10px;
        padding-right: 10px;
    }
	</style>

</head>
<body>
<?php
    $notes=\App\Note::where('type','public')->get();
?>
<div class="py-2" style="background-color:rgb(158,7,7)">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-3 px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <marquee>
                        <h3 style="font-family:Changa;color: #FFFFFF;display: inline">
                            <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($note->content); ?>  &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </h3>
                    </marquee>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco_navbar ftco-navbar-light" id="ftco-navbar" style="font-family:Changa">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand" href="/">HMLS
        </a>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" id="main"><a href="/" class="nav-link pl-0" style="font-size: large">الرئيسية</a></li>
                <li class="nav-item" id="about"><a href="/about" class="nav-link "style="font-size: large" >عن النظام</a></li>
                <li class="nav-item " id="class"><a href="/class" class="nav-link " style="font-size: large">التخصصات</a>
                <li class="nav-item" id="course" ><a href="/course" class="nav-link" style="font-size: large">الدورات المجانية</a></li>
                <li class="nav-item" id="contact"><a href="/contact" class="nav-link" style="font-size: large">تواصل معنا</a></li>

            </ul>
        </div>
              <?php if(Auth::check()): ?>
                <a href="<?php echo e(route('logout')); ?>" class="ml-auto" style="font-size: large" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    تسجيل خروج <i class="fa fa-sign-out" style="color:red!important;"></i>
                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>
                <?php endif; ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span>
            </button>

    </div>
</nav>

<?php echo $__env->yieldContent('content'); ?>


<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container" dir="rtl">
        <div class="row mb-5">
            <div class="col-md-7 col-lg-4">
                <div class="ftco-footer-widget mb-5">
                    <h2 class="ftco-heading-2" style="text-align:right;">معلومات الاتصال</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span> <span class="text"> Syria Lattakia  </span></li>
                            <li><a href="#"><span class="icon icon-phone"> </span><span class="text"> 09999999999 </span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"> </span><span class="text"> admin@hlms.com </span></a></li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-lg-4">
                <div class="ftco-footer-widget mb-5 ml-md-4">

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 text-center">

            </div>
        </div>
    </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery-migrate-3.0.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery-migrate-3.0.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.easing.1.3.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.waypoints.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.stellar.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/aos.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.animateNumber.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/scrollax.min.js')); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="<?php echo e(asset('js/google-map.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<script>
    var owl=$('.our-courses').owlCarousel({
        rtl: true,
        loop: true,
        margin: 10,
        nav: true,
        autoplay: false,
        dots: false,
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
    $("#next").click(function(){
        owl.trigger('next.owl.carousel');
    });
    $("#prev").click(function(){
        owl.trigger('prev.owl.carousel');
    });
</script>
<script>
<?php echo $__env->yieldContent('navscript'); ?>
</script>
</body>
</html>
<?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/front-end/nhome/master.blade.php ENDPATH**/ ?>