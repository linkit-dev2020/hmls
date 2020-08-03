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
                <th>عنوان الإختبار</th>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                <th>التفعيل</th>
                <?php endif; ?>
                <th>الفصل</th>
                <th class="go-m">نوع الملف</th>
                <th>المادة</th>
                <th>العرض</th>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                <th>التعديل</th>
                <?php endif; ?>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1)||Auth::user()->hasRole(2)): ?>
                <th>الحذف</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($test->title); ?></td>
              <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1)||Auth::user()->hasRole(2)): ?>
                <td class="operations">
                  <?php if($test->active): ?>
                  <form action="<?php echo e(route('test.deactivate', $test)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($test->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($test->id+1); ?>').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php else: ?>
                  <form action="<?php echo e(route('test.activate', $test)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($test->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($test->id); ?>').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php endif; ?>
                </td>
                <?php endif; ?>
                <td><?php echo e($test->term); ?></td>
                <td class="go-m"><?php echo e($test->type); ?></td>
                  <?php if($test->subjects->first()!=null): ?>
                <td><?php echo e($test->subjects->first()->name); ?></td>
                  <?php else: ?>
                      <td> - </td>
                  <?php endif; ?>
                <td>
                  <div class="operations show">
                    <a href="<?php echo e(route('test.show', $test)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                <td>
                  <div class="operations update">
                     <a href="<?php echo e(route('test.edit', $test)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="<?php echo e(route('test.destroy',['carousel' => $test->id])); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">
                      <button class="fa fa-trash"  style="border:none; font-size:18px;color:#dd4b39;cursor: pointer;" > </button>
                    </form>
                  </div>
                </td>
                <?php endif; ?>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/tests/index.blade.php ENDPATH**/ ?>