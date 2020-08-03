<?php $__env->startSection('content'); ?>
    <?php if($test->type=="image"): ?>
        <img src="<?php echo e(asset($test->src)); ?>" width="100%">
    <?php elseif($test->type=="video"): ?>
        <?php

        $src = '' ;
        $newSrc= substr($test->src,strpos($test->src,'?v=')+3);
       // echo $newSrc;
        if(strpos($test->src, 'youtu.be')){
            $src=str_replace("/storage//youtu.be/","",$test->src);
        }



        ?>
        <?php if($src!=''): ?>

            <iframe  width="100%" height="240" src="https://www.youtube.com/embed/<?php echo $src;?>"></iframe>

        <?php else: ?>
            <iframe  width="100%" height="240" src="https://www.youtube.com/embed/<?php echo $newSrc;?>"></iframe>

        <?php endif; ?>
    <?php elseif($test->type=="pdf"): ?>
        <a class="btn btn-primary" href="<?php echo e(asset($test->src)); ?>" >تحميل</a>
    <?php elseif($test->type=="word"): ?>
        <a class="btn btn-primary" href="<?php echo e(asset($test->src)); ?>" >تحميل</a>
    <?php elseif($test->type="url"): ?>
        <a class="btn btn-primary" href="<?php echo e(asset($test->src)); ?>" >فتح الرابط</a>
    <?php elseif($test->type=="audio"): ?>
        <a class="btn btn-primary" href="<?php echo e(asset($test->src)); ?>" >فتح الصوت</a>
    <?php endif; ?>


    <br><br>
    <h3 id="att_h" style="text-align: right!important;">مرفقات الاختبار</h3>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('stdashboard.master3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/stdashboard/showTestCourse.blade.php ENDPATH**/ ?>