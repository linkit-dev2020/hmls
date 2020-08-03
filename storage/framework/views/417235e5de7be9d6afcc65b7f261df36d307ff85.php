<?php $__env->startSection('content'); ?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الوحدات الدراسية</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) ||Auth::user()->hasRole(2)): ?>
        <a href="<?php echo e(route('unit.create')); ?>" class="btn btn-success custom-but BP" >إضافة وحدة دراسية <div><i class="fa fa-plus-square" aria-hidden="true"></i></div></a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الوحدات الدراسية</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>اسم الوحدة</th>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) ||Auth::user()->hasRole(2)): ?><th>التفعيل</th><?php endif; ?>

                <th>المادة الدراسية</th>
                <th>الصف</th>
                <th>عرض</th>
                <th>الترتيب</th>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) ||Auth::user()->hasRole(2)): ?>
                <th>تعديل</th>
                <th>حذف</th>
                <?php endif; ?>
                <th> تاريخ الاضافة </th>
                <th>  تاريخ التعديل </th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($unit->title); ?></td>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) ||Auth::user()->hasRole(2)): ?>
                <td class="operations">
                  <?php if($unit->active): ?>
                  <form action="<?php echo e(route('unit.deactivate', $unit)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($unit->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($unit->id+1); ?>').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php else: ?>
                  <form action="<?php echo e(route('unit.activate', $unit)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($unit->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($unit->id+1); ?>').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php endif; ?>
                </td>
                <?php endif; ?>

                <td><?php echo e($unit->subject->name); ?></td>
                <td><?php echo e($unit->subject->class->name); ?></td>
                <td>
                  <div class="operations show">
                    <a href="<?php echo e(route('unit.show', $unit)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                    <?php echo e($unit->order_num); ?>

                </td>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1)||Auth::user()->hasRole(2)): ?>
                <td>
                  <div class="operations update">
                    <a href="<?php echo e(route('unit.edit', $unit)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
               <td>
                     <div class="operations delete">
                          <form action="<?php echo e(route('unit.destroy',['carousel' => $unit->id])); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">
                       <button class="fa fa-trash"  style="border:none; font-size:18px;color:#dd4b39;cursor: pointer;" > </button>

                          </form>
                  </div>
                </td>
                <?php endif; ?>
                <td><?php echo e($unit->created_at); ?></td>
                <td><?php echo e($unit->updated_at); ?></td>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/units/index.blade.php ENDPATH**/ ?>