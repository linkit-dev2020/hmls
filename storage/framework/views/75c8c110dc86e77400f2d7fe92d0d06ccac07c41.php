<?php $__env->startSection('content'); ?>
    <div id="content">
        <div class="header-card table-cards color-grey">
            <div class="row">
                <div class="col-lg-4">
                    <div class="content-header">
                        <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المرفقات </small></h1>
                    </div>
                </div>
                <div class="col-lg-6">
                <a href="<?php echo e(route('attachment.index')); ?>" class="btn btn-primary button-margin-header custom-but pull-left" >العودة
                    <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
                </a>
                </div>
            </div>
        </div>
        <div id="table" class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card table-cards color-grey">
                    <div class="card-body">
                        <div class="content-header">
                            <h2>              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> معلومات المرفق </small>            </h2>
                        </div>
                        <div>
                            <table class="table table-bordered">
                                <tr>cd
                                    <td>الاسم</td>
                                    <td><?php echo e($attachment->name); ?></td>
                                </tr>

                                <tr>
                                    <td>النوع</td>
                                    <td><?php echo e($attachment->type); ?></td>
                                </tr>

                                <tr>
                                    <td>مرتبط مع</td>
                                    <td>
                                        <?php if($attachment->attachmentable_type=='App\Lesson'): ?>
                                            درس
                                        <?php elseif($attachment->attachmentable_type=='App\Deneme'): ?>
                                            دينيمي
                                        <?php elseif($attachment->attachmentable_type=='App\Test'): ?>
                                            اختبار
                                        <?php elseif($attachment->attachmentable_type=='App\test'): ?>
                                            اختبار
                                        <?php else: ?>
                                            -

                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>ملف المرفق</td>
                                    <td>
                                        <?php if($attachment->type=='image'): ?>
                                            <img src="<?php echo e($attachment->src); ?>"  />
                                        <?php elseif($attachment->type=='video'): ?>
                                            <?php echo $attachment->src; ?>

                                        <?php else: ?>
                                            <a class="btn btn-primary" target="_blank" href="<?php echo e(asset($attachment->src)); ?>" >فتح المرفق</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/attachments/show.blade.php ENDPATH**/ ?>