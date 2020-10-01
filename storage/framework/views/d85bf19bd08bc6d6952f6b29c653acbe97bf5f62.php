<?php $__env->startSection('content'); ?>



<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الطلابات على الصفوف</small></h1>
        </div>
      </div>

    </div>
  </div>

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> طلبات الصفوف</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>اسم الطالب </th>
                <th>اسم الصف</th>
                <th>العلامة</th>
                <th>قبول</th>
                <th>حذف</th>

              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($request->student->username); ?></td>

                <td><?php echo e($request->class->name); ?></td>
                <td><?php echo e($request->mark); ?></td>
                  <td>
                      <div class="operations delete">
                          <form action="<?php echo e(route('classrequest.accept',['id' => $request->id])); ?>" method="POST" id="deleteForm">
                              <?php echo csrf_field(); ?>

                              <input type="hidden" name="_method" value="DELETE">
                              <input type="submit" class="btn btn-success" value="قبول">

                              </a>
                          </form>
                      </div>
                  </td>
                  <td>
                      <div class="operations delete">
                          <form action="<?php echo e(route('classrequest.remove',['id' => $request->id])); ?>" method="POST" id="deleteForm">
                              <?php echo csrf_field(); ?>

                              <input type="hidden" name="_method" value="DELETE">
                              <input type="submit" class="btn btn-danger" value="حذف">

                              </a>
                          </form>
                      </div>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\hmls\resources\views/admin/requestclass/index.blade.php ENDPATH**/ ?>