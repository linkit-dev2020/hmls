<?php $__env->startSection('content'); ?>
    <!-- END nav -->
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=752&q=80); background-position: 20% center" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                    <div class="col-md-8 text-center ftco-animate">

                        <h1 class="mb-4"  style="color:#FFFFFF; font-family: Changa">HLMS <h3 style="color:#FFFFFF ;font-family:'changa',sans-serif">نظام التعلم الالكتروني</h3></h1>
                        <p><a href="/login" class="btn btn-secondary px-4 py-3 mt-3" style="margin-right: 20px">تسجيل الدخول</a><a href="/register" class="btn btn-outline-secondary px-4 py-3 mt-3">طالب جديد</a></p>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <section class="ftco-services ftco-no-pb" >
        <div class="container-wrap">
            <div class="row no-gutters">
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-primary">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-teacher"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">كادر أكايمي متكامل</h3>
                            <p > كادر أكاديمي مختص و ذو خبرة في التعليم الألكتروني </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-tertiary">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-reading"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">تخصصات متعددة</h3>
                            <p>  صفوف الكتروني مختلفة للعديد من البرامج الجامعية
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-fifth">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-books"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">تنوع المحتوى</h3>
                            <p>يمكن للطلاب استعراض المحتوى باشكال مختلفة فيديو , كتب الكترونية وغيرها</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-quarternary">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-diploma"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">دورات تقوية اضافية لمختلف البرامج</h3>
                            <p>
                                يوفر النظام دورات اضافية للمقررات بتنوع محتواها

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section" style="direction: rtl!important;text-align: right;font-family: Changa">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    <h2 class="mb-4">التخصصات</h2>
                </div>
            </div>
            <div class="row">
                <?php $i=0; ?>
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 course d-lg-flex ftco-animate">
                    <?php $url="images/course_10.jpg";
                    $i++;
                    ?>
                    <div class="img" style="background-image: url(<?php echo e(asset($url)); ?>);"></div>
                    <div class="text bg-light p-4">
                        <h3><a href="" style="float: right"><?php echo e($class->name); ?></a> <span class="badge badge-pill" style="font-size: medium;text-align: left;float: left"><i class="fa fa-user"></i> <?php echo e($class->stunum); ?></span></h3>
                        <br><p style="float:right"><a href="/stdsh/class/<?php echo e($class->id); ?>" class="btn btn-secondary px-2 py-2 mt-3">عرض </a> </p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>


    <section class="ftco-section" style="direction:rtl!important;font-family: Changa">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    <h2 class="mb-4">الدورات</h2>
                </div>
            </div>
            <div class="row" dir="rtl">
                <?php
                    $arr=["btn-primary","btn-secondary","btn-tertiary","btn-quarternary"];
                    $i=0;

                   $a=0;
                ?>
                <!-- Course begin -->
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $bgs=["bg_1.jpg","bg_2.jpg","bg_3.jpg","bg_4.jpg","bg_5.jpg","bg_11.jpg","bg_33.jpg"];
                        $url="images/course_10.jpg";
                        $a++;
                    ?>
                <div class="col-md-6 col-lg-3 ftco-animate" style="margin-top:10px;">
                    <div class="pricing-entry bg-light pb-4 text-center">
                        <div style="height: 200px;">
                            <span class="badge badge-pill" style="font-size: medium"><i class="fa fa-user"></i> <?php echo e($course->stunum); ?></span>
                            <p><span class="price"><?php echo e($course->title); ?></span> </p>
                        </div>
                        <div class="img" style="background-image: url(<?php echo e(asset($url)); ?>);background-position: center;
                        background-repeat: no-repeat!important;
                        background-size: 100% 118%!important;
                        position: relative!important;height:200px;"></div>
                        <div class="px-4">
                        </div>
                    </div>
                </div>
                <!-- end of course -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </section>
    <section class="ftco-gallery">
        <div class="container-wrap">
            <div class="row no-gutters">
                <div class="col-md-3 ftco-animate">
                    <a href="images/image_1.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/course-1.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="images/image_2.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/image_2.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="images/image_3.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/image_3.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="images/image_4.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/image_4.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('navscript'); ?>
    $("#main").addClass("active");
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.nhome.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/front-end/nhome/home.blade.php ENDPATH**/ ?>