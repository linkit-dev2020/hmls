<?php $__env->startSection('content'); ?>

<div id="content">
  <?php if(Auth::user()->hasAnyRole([0,1])): ?>
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المواد الدراسية</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="<?php echo e(route('subject.create')); ?>" class="btn btn-success custom-but BP" >إضافة مادة <div><i class="fa fa-plus-square" aria-hidden="true"></i></div></a>
      </div>
    </div>
  </div>
  <?php elseif(Auth::user()->hasAnyRole([2,3])): ?>
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> المواد الدراسية</small></h1>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12  col-sm-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> المواد الدراسية</small>
            </h2>
          </div>
          <table id="myTable" style="width: 90%!important;;">
            <thead>
              <tr> 
                <th>اسم المادة</th>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1)): ?>
                <th>التفعيل</th>
                <?php endif; ?>
                <th>الصف</th>
                <th>عدد الوحدات الدراسية</th>
                <th>قابلية التنزيل</th>
                <th>عرض</th>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1)): ?>
                <th>تعديل</th>
                <th>حذف</th>
                <?php endif; ?>
                  <th>الترتيب</th>

              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($subject->name); ?></td>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1)): ?>
                 <td class="operations">
                  <?php if($subject->active): ?>
                  <form action="<?php echo e(route('subject.deactivate', $subject)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($subject->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($subject->id+1); ?>').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form> 
                  <?php else: ?>
                  <form action="<?php echo e(route('subject.activate', $subject)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($subject->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($subject->id); ?>').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php endif; ?>          
                </td>
                <?php endif; ?>
                <td><?php echo e($subject->class->name); ?></td>
                <td><?php echo e($subject->units->count()); ?></td>
                <?php if($subject->downloable): ?>
                <td>قابلة</td>
                <?php elseif(!$subject->downloable): ?>
                <td>غير قابلة</td>
                <?php endif; ?>
                <td>
                  <div class="operations show">
                    <a href="<?php echo e(route('subject.show', $subject)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1)): ?>
                <td>
                  <div class="operations update">
                    <a href="<?php echo e(route('subject.edit', $subject)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
              
                  
                  
            <td>
                     <div class="operations delete">
                          <form action="<?php echo e(route('subject.destroy',['carousel' => $subject->id])); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">    
                       <button class="fa fa-trash"  style="border:none; font-size:18px;color:#dd4b39;cursor: pointer;" > </button>
                 
                          </form>  
                  </div>
                </td>
                
                <?php endif; ?>
                <td><?php echo e($subject->order_num); ?></td>

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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\hmls\resources\views/admin/subjects/index.blade.php ENDPATH**/ ?>