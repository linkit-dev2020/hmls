<?php $__env->startSection('content'); ?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الإختبارات </small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
        <a href="<?php echo e(route('test.create')); ?>" class="btn btn-success myhover BP" role="button">إضافة إختبار<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div id="table" class="row">
    <div class="col-lg-8 col-m-u">
      <div class="card table-cards color-grey">
        <div class="content-header">
          <h2>
            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الإختبارات</small>
          </h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>اسم الطالب</th>
                <th>الوظيفة</th>
                <th>الملف</th>
                <th>العلامة</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $st; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e(\App\User::find($test->student_id)->full_name); ?></td>
                <td><?php echo e(\App\Test::find($test->subject_id)->title); ?></td>
                <td><a href="<?php echo e(asset($test->url)); ?>" target="blank">تحميل</a></td>
                <td>
                    <form action="gradetest" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="student_id" value="<?php echo e($test->student_id); ?>">
                        <input type="hidden" name="subject_id" value="<?php echo e($test->subject_id); ?>">
                        <input type="text" name="grade">
                        <input type="submit" class="btn btn-primary" value="تقييم">
                    </form>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\hmls\resources\views/admin/tests/grades.blade.php ENDPATH**/ ?>