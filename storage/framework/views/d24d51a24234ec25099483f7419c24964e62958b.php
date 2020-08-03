<?php $__env->startSection('content'); ?>
    <section class="hero-wrap hero-wrap-2" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=752&q=80); background-position: 20% center" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread">تواصل معنا</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="">توصل معنا <i class="ion-ios-arrow-forward"></i></a></span> <span>الرئيسية <i class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-4 d-flex">
                    <div class="bg-light align-self-stretch box p-4 text-center">
                        <h3 class="mb-4">العنوان</h3>
                        <p>سوريا اللاذقية</p>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="bg-light align-self-stretch box p-4 text-center">
                        <h3 class="mb-4">رقم الهاتف</h3>
                        <p><a href="">099999999</a></p>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="bg-light align-self-stretch box p-4 text-center">
                        <h3 class="mb-4">البريد الالكتروني</h3>
                        <p><a href="mailto:info@yoursite.com">admin@hlms.com</a></p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
        <div class="container">
            <div class="row d-flex align-items-stretch no-gutters">

                <div class="col-md-12 d-flex align-items-stretch">
                    <div class="mapouter"><div class="gmap_canvas"><iframe style="width: 100%!important;" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=antakya&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>Google Maps Generator by <a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:100%}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%!important;}</style></div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('navscript'); ?>
    $("#contact").addClass("active");
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.nhome.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/front-end/nhome/contact.blade.php ENDPATH**/ ?>