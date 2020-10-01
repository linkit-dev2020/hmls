<?php $__env->startSection('title'); ?>
    <?php if(Auth::check()): ?>
        حسابي
    <?php else: ?>
    HMLS
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('marq'); ?>
    <?php
        $notes=\App\Note::where('class_id',$class->id)->where('type','private')->get();

    ?>

    <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($note->content); ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .course_image{
            width: 100%!important;
            height: 250px!important;
            text-align: center!important;
            background-color: #fff!important;
        }
        .course_body{
            width: 100%!important;
            height: 100px!important;
        }
    </style>
    <div class="language ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if( session('success') ): ?>

                        <div class = "alert alert-success">

                            <?php echo e(session('success')); ?>


                        </div>

                    <?php endif; ?>

                    <?php if( session('error') ): ?>

                        <div class = "alert alert-danger">

                            <?php echo e(session('error')); ?>


                        </div>

                    <?php endif; ?>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <div class="language_title wow flipInX">مواد , <?php echo e($class->name); ?></div>
                </div>
            </div>
        </div>
    </div>


    <div class="courses">
        <div class="container">
            <div class="row courses_row">
            <?php $__currentLoopData = $class->subjects->sortBy('order_num'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course wow fadeInRight">
                            <div class="course_image"><img src="<?php echo e(Storage::url($sub->cover)); ?>" alt=""></div>
                            <div class="course_body">
                                <?php
                                $cid=$class->id;
                                $sid=-1;
                                if(Auth::check())
                                    $sid=Auth::user()->id;
                                $match=['student_id'=>$sid,'class_id'=>$cid];
                                $a=\App\ClassStudent::where('student_id',$sid)->where('class_id',$cid)->first();
                                $new=true;
                                if($a!==null&&$a->count()>0)
                                {
                                    $new=false;

                                }

                                ?>
                                <?php if(Auth::check()&&Auth::user()->hasAnyRole([0,1])): ?>
                                        <div class="course_title"><a href="/stdsh/show/<?php echo e($sub->id); ?>/"><?php echo e($sub->name); ?></a></div>
                                <?php else: ?>
                                        <?php if($new||!$sub->active): ?>
                                            <div class="course_title"><a><?php echo e($sub->name); ?></a></div>
                                        <?php else: ?>
                                            <div class="course_title"><a href="/stdsh/show/<?php echo e($sub->id); ?>/"><?php echo e($sub->name); ?></a></div>
                                        <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <div class="course_footer d-flex flex-row align-items-center justify-content-start">
                                <div class="course_rating ml-auto"><i class="fa <?php if($sub->active): ?> fa-check-circle <?php else: ?> fa-times-circle <?php endif; ?>" aria-hidden="true"></i>
                                    <span>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Course -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>







        <br><br><br><br>
        <br><br><br><br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('stdashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\hmls\resources\views/stdashboard/courses.blade.php ENDPATH**/ ?>