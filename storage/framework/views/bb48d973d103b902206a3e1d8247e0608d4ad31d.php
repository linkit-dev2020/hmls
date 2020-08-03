<?php $__env->startSection('content'); ?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المرفقات</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="<?php echo e(route('attachment.create')); ?>" class="btn btn-success myhover BP" role="button">إضافة مرفق <div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>
  
  <div id="table" class="row">
    <div class="col-lg-8 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-picture-o" aria-hidden="true" style="font-size:24px;"></i> المرفقات</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>اسم الملف</th>
                <th>النوع</th>
                <th>نوع التبعية</th>
                <th>عرض</th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($attachment->name); ?></td>
                <?php if($attachment->type === 'file'): ?>
                <td>ملف</td>
                <?php elseif($attachment->type === 'image'): ?>
                <td>صورة</td>
                <?php else: ?>
                  <td></td>
                <?php endif; ?>
                <?php if($attachment->attachmentable_type === 'App\Lesson'): ?>
                <td>لدرس</td>
                <?php elseif($attachment->attachmentable_type === 'App\Deneme'): ?>
                <td>لدينيمي</td>
                <?php elseif($attachment->attachmentable_type === 'App\Test' || $attachment->attachmentable_type === 'App\test'): ?>
                <td>للأختبار</td>
                  <?php else: ?>
                  <td></td>
                <?php endif; ?>
                <td>
                  <div class="operations update">
                    <a href="<?php echo e(route('attachment.show', $attachment)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations update">
                    <a href="<?php echo e(route('attachment.edit', $attachment)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="<?php echo e(route('attachment.destroy',$attachment)); ?>" method="POST">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">    
                      <button id="<?php echo e($attachment->id); ?>" class=" btn-xs delete-button" style="display:none;">
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </button>
                      <a herf="javascript:;" onclick="$('#<?php echo e($attachment->id); ?>').click();" >
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/attachments/index.blade.php ENDPATH**/ ?>