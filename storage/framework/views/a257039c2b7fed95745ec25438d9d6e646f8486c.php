<?php $__env->startSection('content'); ?>

<?php 
 
  $activeArray= [ true =>"مفعلة", false => "غير مفعلة"];
                
 ?>

<div id="content">

    <div class="header-card table-cards color-grey">
        <div class="row">
        <div class="col-lg-8">
            <div class="content-header">
            <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة دورة <?php echo e($course->title); ?></small></h1>
            </div>
        </div> 
        </div>
    </div>

    <div class="row" id="table">
        <div class="card-deck">
            <div class="col-lg-6">
                <div class="card color-grey">
                    <div class="card-header">تعديل الدورة <i class="fa fa-edit" aria-hidden="true"></i></div>
                        <div class="card-body">

                            <form action="<?php echo e(route('course.update', $course)); ?>" method="POST">
                                <div class="form-group">
                                    <?php echo csrf_field(); ?>

                                    <input type="hidden" name="_method" value="PATCH">
                                    
                                    <label for="course"><h5>الدورة الدراسية :</h5></label>
                                    <input type="text" class="form-control" id="course" value="<?php echo e($course->title); ?>" name="title">
                                    <?php if($errors->has('title')): ?>
                                <span class="text-danger"><?php echo e($errors->first('title')); ?></span>
                                    <?php endif; ?>
                                    
                                    
                                </div>

                                <div class="form-group">
                                    <label for="course"><h5>الترتيب</h5></label>
                                    <input type="number" class="form-control" id="order"  min="1" max="9999999" name="order" required placeholder="الترتيب" value="<?php echo e($course->order_num); ?>">

                                    <br>
                                    <label for="stunum">عدد الطلاب </label>
                                    <input type="number" class="form-control" value="<?php echo e($course->stunum); ?>" id="stunum" min="1" max="100000000" name="stunum" required placeholder="عدد الطلاب">

                                </div>

                                <button type="submit" class="btn btn-success myhover">تعديل</button>
                                <a href="<?php echo e(route('course.index')); ?>" class="btn btn-default button2" style="margin-right:5px">إلغاء</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/courses/edit.blade.php ENDPATH**/ ?>