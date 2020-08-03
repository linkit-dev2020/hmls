<?php $__env->startSection('content'); ?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-6">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة روابط تطبيق الواتس أب </small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="<?php echo e(route('whatsapplink.create')); ?>" class="btn btn-success custom-but BP" >إضافة رابط <div><i class="fa fa-plus-square" aria-hidden="true"></i></div></a>
      </div>
    </div>
  </div>
  
  <div id="table" class="row">
    <div class="col-lg-10">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> روابط التطبيق</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>روابط التطبيق</th>
                <th>النوع</th>
                <th>التابع ل</th>
                <th>الترتيب</th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $whatsappLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $whatsappLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($whatsappLink->url); ?></td>
                <?php if($whatsappLink->type === 'lessons'): ?>
                <td>دروس</td>
                <?php elseif($whatsappLink->type === 'homeworks'): ?>
                <td>وظائف</td>
                <?php else: ?>
                <td></td>
                <?php endif; ?>
                <?php if($whatsappLink->linkable_type === 'App\ClassRoom'): ?>
                <td><?php echo e($whatsappLink->linkable->name); ?></td>
                <?php elseif($whatsappLink->linkable_type === 'App\Course'): ?>
                    <?php if($whatsappLink->linkable!=null): ?>
                <td><?php echo e($whatsappLink->linkable->title); ?></td>
                        <?php endif; ?>
                    <?php else: ?>
                <td></td>
                <?php endif; ?>
                <td><?php echo e($whatsappLink->order); ?></td>
                <td>
                  <div class="operations update">
                    <a href="<?php echo e(route('whatsapplink.edit', $whatsappLink)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="<?php echo e(route('whatsapplink.destroy',['class' => $whatsappLink->id])); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">    
                      <button id="<?php echo e($whatsappLink->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#<?php echo e($whatsappLink->id); ?>').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/whatsapplinks/index.blade.php ENDPATH**/ ?>