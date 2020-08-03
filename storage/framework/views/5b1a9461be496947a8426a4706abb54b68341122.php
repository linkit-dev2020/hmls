<?php $__env->startSection('content'); ?>
    <?php if($test->type=="image"): ?>
        <img src="<?php echo e(asset($test->src)); ?>" width="100%">
    <?php elseif($test->type=="video"): ?>

    <?php elseif($test->type=="pdf"): ?>

    <?php elseif($test->type=="word"): ?>

    <?php elseif($test->type="url"): ?>

    <?php elseif($test->type=="audio"): ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('stdashboard.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/stdashboard/showTest.blade.php ENDPATH**/ ?>