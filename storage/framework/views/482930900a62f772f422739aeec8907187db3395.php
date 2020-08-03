<?php $__env->startSection('content'); ?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة النصائح</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="<?php echo e(route('advice.create')); ?>" class="btn btn-success myhover BP" role="button">إضافة نصيحة<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>
  
  <div id="table" class="row">
    <div class="col-lg-8 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-picture-o" aria-hidden="true" style="font-size:24px;"></i> النصائح</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>العنوان</th>
                <th>النوع</th>
                <th>التفعيل</th>
                <th>عرض</th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $advices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($advice->title); ?></td>
                <td><?php echo e($advice->type); ?></td>
                <td class="operations">
                  <?php if($advice->active): ?>
                  <form action="<?php echo e(route('advice.deactivate', $advice)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($advice->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($advice->id+1); ?>').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form> 
                  <?php else: ?>
                  <form action="<?php echo e(route('advice.activate', $advice)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($advice->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($advice->id+1); ?>').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php endif; ?>          
                </td>
                <td>
                  <div class="operations update">
                    <a href="<?php echo e(route('advice.show', $advice)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations update">
                    <a href="<?php echo e(route('advice.edit', $advice)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                      <td>
                     <div class="operations delete">
                          <form action="<?php echo e(route('advice.destroy',['carousel' => $advice->id])); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">    
                       <button class="fa fa-trash"  style="border:none; font-size:18px;color:#dd4b39;cursor: pointer;" > </button>
                 
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/advices/index.blade.php ENDPATH**/ ?>