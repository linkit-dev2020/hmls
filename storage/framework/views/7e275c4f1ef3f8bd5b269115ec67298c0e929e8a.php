<?php $__env->startSection('content'); ?>

<div id="content">
  
  <?php if(Auth::user()->hasAnyRole([0,1])): ?>
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدورات الدراسية</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="<?php echo e(route('course.create')); ?>" class="btn btn-success myhover BP" role="button">إضافة دورة دراسية<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>
  <?php elseif(Auth::user()->hasAnyRole([2,3])): ?>
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> الدورات الدراسية</small></h1>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if(Auth::user()->hasAnyRole([0,1,3])): ?>
  <div id="table" class="row">
    <div class="col-lg-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="content-header">
          <h2>
            <?php if(Auth::user()->hasAnyRole([0,1])): ?>
            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>الدورات الدراسية</small>
            <?php elseif(Auth::user()->hasAnyRole([2,3])): ?>
            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>طلبات الأنضمام إلى الدورات الدراسية المتوفرة </small>
            <?php endif; ?>
          </h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>اسم الدورة</th>
                <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                <th>التفعيل</th>
                <th>العرض</th>
                <th>التعديل</th>
                <th>الحذف</th>
                <th>الترتيب</th>
               <th>تاريخ الاضافة</th>
                                      <th>تاريخ التعديل</th>
            
                <?php endif; ?>
                <?php if(Auth::user()->hasRole(3)): ?>
                <th>طلب انضمام</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($course->title); ?></td>
                <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                <?php if($course->active): ?>
                <td>فعال</td>
                <?php elseif(!$course->active): ?>
                <td>غير فعال</td>
                <?php endif; ?>
                <td>
                  <div class="operations show">
                    <a href="<?php echo e(route('course.show', $course)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations update">
                     <a href="<?php echo e(route('course.edit', $course)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="<?php echo e(route('course.destroy', $course)); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">    
                      <button id="<?php echo e($course->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#<?php echo e($course->id); ?>').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </a>
                    </form>
                    
                  </div>
                </td>
                  <td><?php echo e($course->order_num); ?></td>
                  <td><?php echo e($course->created_at); ?></td>
                  <td><?php echo e($course->updated_at); ?></td>
                <?php endif; ?>

              
                <?php if(Auth::user()->hasRole(3)): ?>
                <td>
                    <form action="<?php echo e(route('courserequest.store')); ?>" method="POST" id="makeCourseFreeForm" style="display:inline; margin-right:10px;">
                       <?php echo csrf_field(); ?>

                       <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
                       <input type="submit" class="btn btn-success" value="انضم">
                    </form>
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
  <?php endif; ?>


  <?php if(Auth::user()->hasAnyRole([2])): ?>

  <div id="table" class="row">
    <div class="col-lg-12">
      <div class="card table-cards color-grey">
        <div class="content-header">
          <h2>
            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>الدورات الدراسية المنضم إليها</small>
          </h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>اسم الدورة</th>
                <th>العرض</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $mycourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mycourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($mycourse->title); ?></td>
                
                <td>
                  <div class="operations show">
                    <a href="<?php echo e(route('course.show', $mycourse)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
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

  <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/courses/index.blade.php ENDPATH**/ ?>