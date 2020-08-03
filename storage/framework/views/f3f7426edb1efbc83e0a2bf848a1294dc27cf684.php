<?php $__env->startSection('content'); ?>

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الوحدات الدراسية</small></h1>
        </div>
      </div>
        <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
      <div class="col-lg-4">
        <a href="<?php echo e(route('unit.index')); ?>" class="btn btn-primary button-margin-header custom-but pull-left" > إدارة كافة الوحدات
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div>
        <div class="col-lg-2">
                <a href="/lessons/create?selectedunit=<?php echo e($unit->id); ?>" class="btn btn-success button-margin-header" style="margin-right: 22px" >إضافة درس
                    <i class="fa fa-plus" aria-hidden="true" style="font-size:16px"></i>
                </a>
            </div>
                  <?php endif; ?>
    </div>
  </div>

    <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
      <div id="table" class="row">
    <div class="card-deck">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">اضافة درس للوحدة</div>

              <form action="<?php echo e(route('unit.attachlesson', ['unit' => $unit->id])); ?>" enctype="multipart/form-data" method="POST">
                      <?php echo csrf_field(); ?>


                <div class="form-group">
                  <label for="lesson">اختر الدرس :</label>
                  <select class="form-control form-control-select mt-3" id="lesson" name="lesson">
                    <option selected>-- اختر درس --</option>

                    <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                     <option value="<?php echo e($lesson->id); ?>"><?php echo e($lesson->title); ?></option>


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </select>

                </div>

                <button type="submit" class="btn btn-success myhover">إضافة</button>

              </form>

          </div>
        </div>
      </div>
    </div>
  </div>

    <?php endif; ?>

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدروس المعتمدة ضمن <?php echo e($unit->title); ?></small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>عنوان الدرس</th>
                  <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                <th>التفعيل</th>
                  <?php endif; ?>
                  <th>المقدمة</th>
                  <th>الترتيب</th>
                <th>العرض</th>
                  <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                <th>التعديل</th>
                <th>الحذف</th>
                      <th>فصل عن الوحدة</th>
                      <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $unitLessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php if($lesson->active === 0 && Auth::user()->hasRole(3)): ?>
              <?php else: ?>
              <tr>
               <td><?php echo e($lesson->title); ?></td>
                  <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
               <td>

                <?php if($lesson->active): ?>
                  <form action="<?php echo e(route('lesson.deactivate', $lesson)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="dectivate<?php echo e($lesson->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#dectivate<?php echo e($lesson->id); ?>').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php else: ?>
                  <form action="<?php echo e(route('lesson.activate', $lesson)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="activate<?php echo e($lesson->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#activate<?php echo e($lesson->id); ?>').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php endif; ?>
               </td>
                  <?php endif; ?>
               <td><?php echo e($lesson->intro); ?></td>
               <td><?php echo e($lesson->order_num); ?></td>
               <td>
                  <div class="operations show">
                    <a href="<?php echo e(route('lesson.show', $lesson)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                <td>
                  <div class="operations update">
                     <a href="<?php echo e(route('lesson.edit', $lesson)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="<?php echo e(route('lesson.destroy', $lesson)); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">
                      <button id="delete<?php echo e($lesson->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#delete<?php echo e($lesson->id); ?>').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </a>
                    </form>
                  </div>
                </td>
                      <td>
                          <div class="operations delete">
                              <form action="<?php echo e(route('unit.deletelesson',['unit' => $unit->id])); ?>" method="POST" id="deleteForm">
                                  <?php echo csrf_field(); ?>

                                  <input type="hidden" name="lesson_id" value="<?php echo e($lesson->id); ?>">
                                  <button id="deattach<?php echo e($lesson->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                  <a herf="javascript:;" class="" onclick="$('#deattach<?php echo e($lesson->id); ?>').click();" >
                                      <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                  </a>
                              </form>
                          </div>
                      </td>
                <?php endif; ?>
              </tr>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/units/show.blade.php ENDPATH**/ ?>