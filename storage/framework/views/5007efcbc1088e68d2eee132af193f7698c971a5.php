<?php $__env->startSection('content'); ?>
    <section class="hero-wrap hero-wrap-2" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=752&q=80); background-position: 20% center" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread" style="font-family: Changa">التخصصات والبرامج</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="">classes <i class="ion-ios-arrow-forward"></i></a></span> <span>الرئيسية <i class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section" style="direction:rtl!important;text-align: right;font-family: Changa">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                </div>
            </div>
            <div class="row">
                <?php $i=0; ?>
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 course d-lg-flex ftco-animate">
                        <?php $url="images/course-".(($i%13)+1).".jpg";
                        $i++;
                        ?>
                        <div class="img" style="background-image: url(<?php echo e(asset($url)); ?>);"></div>
                            <div class="text bg-light p-4">
                                <h3><a href="" style="float: right"><?php echo e($class->name); ?></a> <span class="badge badge-pill" style="font-size: medium;text-align: left;float: left"><i class="fa fa-user"></i> <?php echo e($class->students()->count()); ?></span></h3>
                                <br><p style="float:right"><a href="/stdsh/class/<?php echo e($class->id); ?>" class="btn btn-secondary px-2 py-2 mt-3">عرض </a> </p>
                            </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('navscript'); ?>
    $("#class").addClass("active");
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.nhome.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\hmls\resources\views/front-end/nhome/class.blade.php ENDPATH**/ ?>