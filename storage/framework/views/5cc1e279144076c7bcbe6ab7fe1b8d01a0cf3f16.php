<?php $__env->startSection('content'); ?>

<div id="content">
  
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدروس </small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
        <a href="<?php echo e(route('lesson.create')); ?>" class="btn btn-success myhover BP" role="button">إضافة درس<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 ">
      <div class="card table-cards color-grey">
        <div class="content-header">
          <h2>
            <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدروس</small>
          </h2>
        </div>
        <div class="card-body">
          <table id="myTable" class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>عنوان الدرس</th>
                <th>نوع الملف</th>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                <th>التفعيل</th>
                <?php endif; ?>
                <th>العرض</th>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                <th>التعديل</th>
                <th>الحذف</th>

                <?php endif; ?>
                         <th>الترتيب</th>

                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1)): ?>
                <th>فصل عن مادة</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                    <?php echo e($lesson->title); ?>

                 </td>
                <td><?php echo e($lesson->type); ?>

               
                </td>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                <td class="operations">
                  <?php if($lesson->active): ?>
                  <form action="<?php echo e(route('lesson.deactivate', $lesson)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($lesson->id); ?>deact" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($lesson->id); ?>deact').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form> 
                  <?php else: ?>
                  <form action="<?php echo e(route('lesson.activate', $lesson)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($lesson->id); ?>act" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($lesson->id); ?>act').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php endif; ?>          
                </td>
                <?php endif; ?>
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
                     
                               <button id="<?php echo e($lesson->id); ?>del" class=" btn-xs delete-button" style="display:none;"></button>
                 
                      </span>
                    </form> 
                     <form action="<?php echo e(route('lesson.destroy', $lesson)); ?>" method="POST" id="deleteForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($lesson->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($lesson->id); ?>del').click();" >
                      <i class="fa fa-trash" aria-hidden="true" style="font-size:18px;color:red;cursor: pointer;"></i>
                    </a>
                  </form> 
               
                  </div>
                </td>
                   <?php endif; ?>
                <td><?php echo e($lesson->order_num); ?></td>

                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1)): ?>
                <td>
               <?php  $unit = DB::table('lesson_unit')->where('lesson_id', $lesson->id)->first(); ?>
                  <?php  if(!is_null($unit)): ?>
                  <div class="operations delete">
                    <form action="<?php echo e(route('unit.deletelesson',['unit' => $unit->unit_id])); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <button id="<?php echo e($unit->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#<?php echo e($unit->unit_id); ?>').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </a>
                    </form>
                  </div>
                  <?php  endif; ?>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\hmls\resources\views/admin/lessons/index.blade.php ENDPATH**/ ?>