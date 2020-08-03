<?php $__env->startSection('content'); ?>

<?php 
  use App\Deneme;
?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدينيمي</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="<?php echo e(route('deneme.create')); ?>" class="btn btn-success myhover BP" role="button">إضافة دينيمي<div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>
  
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدينيمي</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>العنوان</th>
                <th>الفعالية</th>
                <th>الفصل</th>
                <th>النوع</th>
                <th>عرض</th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $denemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deneme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($deneme->title); ?></td>
                <?php if($deneme->active): ?>
                <td class="operations">
                  <form action="<?php echo e(route('deneme.deactivate', $deneme)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($deneme->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($deneme->id); ?>').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form>
                </td>
                <?php elseif(!$deneme->active): ?>
                <td class="opreations">
                  <form action="<?php echo e(route('deneme.activate', $deneme)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($deneme->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($deneme->id); ?>').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                </td>
                <?php endif; ?>
                <td><?php echo e($deneme->term); ?></td>
                <td><?php echo e($deneme->type); ?></td>
                <td>
                  <div class="operations show">
                    <a href="<?php echo e(route('deneme.show', $deneme)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations update">
                    <a href="<?php echo e(route('deneme.edit', $deneme)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
               <td>
                     <div class="operations delete">
                          <form action="<?php echo e(route('deneme.destroy',['carousel' => $deneme->id])); ?>" method="POST" id="deleteForm">
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/denemes/index.blade.php ENDPATH**/ ?>