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
        <?php echo $test->src; ?>

    <?php elseif($test->type=="pdf"): ?>
        <a class="btn btn-primary" href="<?php echo e(asset($test->src)); ?>" >تحميل</a>
    <?php elseif($test->type=="word"): ?>
        <a class="btn btn-primary" href="<?php echo e(asset($test->src)); ?>" >تحميل</a>
    <?php elseif($test->type="url"): ?>
        <a class="btn btn-primary" href="<?php echo e(asset($test->src)); ?>" >فتح الرابط</a>
    <?php elseif($test->type=="audio"): ?>
        <a class="btn btn-primary" href="<?php echo e(asset($test->src)); ?>" >فتح الصوت</a>
    <?php endif; ?>

    <?php if( session('success') ): ?>
        <div class = "alert alert-success">
         <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <br><br>
    <h3>التسليم</h3>
    <form action="/uploadtest" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="file" name="file" >
        <input type="hidden" name="subject_id" value="<?php echo e($test->id); ?>" />
        <input type="hidden" name="student_id" value="<?php echo e(Auth::user()->id); ?>" />
        <input type="submit" value="upload">
    </form>
    <h3>العلامة:</h3>
    <?php
        $mod = \App\STest::where('student_id',Auth::user()->id)->where('subject_id',$test->id)->get();
        if(count($mod))
            echo $mod->first()->grade;
        else
            echo 'لم يتم التقييم بعد';
    ?>
    <h3 id="att_h" style="text-align: right!important;">مرفقات الاختبار</h3>

    <ul class="list-group">
        <?php $__currentLoopData = $test->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script>
                document.getElementById("att_h").style.display='block';
            </script>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="<?php echo e(asset($att->src)); ?>" ><?php echo e($att->name); ?></a>
                <?php if($att->type=='pdf'): ?>
                    <span class="badge badge-primary badge-pill"><i class="fa fa-file-pdf-o"></i></span>
                <?php elseif($att->type=='word'): ?>
                    <span class="badge badge-primary badge-pill"><i class="fa fa-file-word-o"></i></span>
                <?php elseif($att->type=='url'): ?>
                    <span class="badge badge-primary badge-pill"><i class="fa fa-globe"></i></span>
                <?php elseif($att->type=='video'): ?>
                    <span class="badge badge-primary badge-pill"><i class="fa fa-file-video-o"></i></span>
                <?php elseif($att->type=='image'): ?>
                    <span class="badge badge-primary badge-pill"><i class="fa fa-file-image-o"></i></span>
                <?php endif; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('stdashboard.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/stdashboard/showTest.blade.php ENDPATH**/ ?>