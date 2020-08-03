<?php $__env->startSection('content'); ?>

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الصفوف</small></h1>
        </div>
      </div>
    </div>
  </div>
  <div id="table" class="row">
    <div class="card-deck">       
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة ملاحظة <i class="fa fa-plus-square" aria-hidden="true"></i></div>
              
              <form action="<?php echo e(route('notes.update',$note)); ?>" method="POST">
                      <?php echo csrf_field(); ?>

                <div class="form-group">

                    <div class="radioG">
                        <h5> النوع :</h5>
                        <div class="radio">
                            <input type="radio" name="type" value="public" onclick="hideClasses()" <?php echo e($note->type ==='public' ? 'checked' : ''); ?> >
                            <label>عامة</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="type" value="private" onclick="showClasses()" <?php echo e($note->type ==='private' ? 'checked' : ''); ?>>
                            <label> خاصة</label>
                        </div>
                    </div>

                    <div id="class_select" <?php if($note->type=='public'): ?><?php echo e('style=display:none'); ?> <?php endif; ?>>
                  <label for="class_id"><h5>الصف الدراسي:</h5></label>
                  <select name="class_id" id="class_id" class="form-control">
                  <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($class->id); ?>" <?php echo e($note->class_id === $class->id ? "selected" : ""); ?>><?php echo e($class->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>

                  <?php if($errors->has('class_id')): ?>
                  <span class="text-danger">* <?php echo e($errors->first('class_id')); ?></span>
                  <?php endif; ?>
                </div>
                </div>

                  <script>
                      function showClasses()
                      {
                          document.getElementById("class_select").style.display='block';
                      }
                      function hideClasses()
                      {
                          document.getElementById('class_select').style.display='none';
                      }
                  </script>

                <div class="form-group">
                 <label for="class_id"><h5> نص الملاحظة:</h5></label>
                 <input type="text" class="form-control" name="content" value="<?php echo e($note->content); ?>">
                </div>
                <input type="hidden" name = "_method" value="PUT">
                <button type="submit" class="btn btn-success button1">تعديل</button>
                <a href="<?php echo e(route('notes.index')); ?>" class="btn btn-default button2" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/notes/edit.blade.php ENDPATH**/ ?>