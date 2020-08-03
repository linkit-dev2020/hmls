<?php $__env->startSection('content'); ?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
          <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدورات الدراسية</small></h1>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">            
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة دورة تدريسية <i class="fa fa-plus-square" aria-hidden="true"></i></div>

              <form action="<?php echo e(route('course.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                  <label for="course"><h5>الدورة الدراسية :</h5></label>
                  <input type="text" class="form-control" id="course" name="title" required placeholder="اسم الدورة التدريسية الجديدة">
                  <?php if($errors->has('title')): ?>
                  <span class="text-danger"><?php echo e($errors->first('course')); ?></span>
                  <?php endif; ?>
                </div>

                  <div class="form-group">
                      <label for="course"><h5>الترتيب</h5></label>
                      <input type="number" min="1" max="9999999" class="form-control" id="order" name="order" required placeholder="الترتيب">
                      <br>
                      <label for="stunum">عدد الطلاب </label>
                      <input type="number" class="form-control" id="stunum" min="1" max="100000000" name="stunum" required placeholder="عدد الطلاب">

                  </div>
                <div class="radioG">
                  <h5>تفعيل الدورة التدريسية :</h5>
                  <div class="radio">
                    <input type="radio" name="active" value="1" checked>
                    <label>مفعلة</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" value="0">
                    <label>غير مفعلة</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-success myhover">إضافة</button>
                <a href="<?php echo e(route('course.index')); ?>" class="btn btn-default button2" style="margin-right:5px">إلغاء</a>
              </form>

            </div>
          </div>
        </div>   
      </div>
    </div>

  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/courses/create.blade.php ENDPATH**/ ?>