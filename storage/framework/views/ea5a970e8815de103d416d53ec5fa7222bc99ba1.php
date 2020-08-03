<?php $__env->startSection('content'); ?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة تشكرات الطلاب </small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل تشكر الطالب <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

              <form action="<?php echo e(route('studentthank.update', $studentThank)); ?>" enctype="multipart/form-data" method="POST">
                      <?php echo csrf_field(); ?>

                      <?php echo method_field('PUT'); ?>

                <!--<img src="<?php echo e($studentThank->src); ?>" alt="Picture" width="80%" height="60%" style="margin-bottom: 20px;">-->
                <div class="form-group">
                  <label for="typeField">نوع التشكر :</label>
                  <select class="form-control form-control-select mt-3" id="typeField" name="type">
                   
                    <option value="img+text" <?php echo e($studentThank->type === 'img+text' ? "selected" : ""); ?>>صورة و نص</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">ملف الشكر :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="thankFile" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="thankFile"><?php echo e($studentThank->src); ?> 
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="opinion"><h5>اكتب نص الرأي :</h5></label>
                  <textarea class="form-control" id="opinion" name="content" rows="3" required><?php echo e($studentThank->content); ?></textarea>
                </div>
                <div class="form-group">
                  <label for="orderField">ترتيب العرض :</label>
                    <input type="number" class="form-control form-control-range mt-3" id="orderField" name="order" />
                </div>
                <button type="submit" class="btn btn-success myhover">تعديل</button>
                <a href="<?php echo e(route('studentthank.index')); ?>" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>

          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/studentthanks/edit.blade.php ENDPATH**/ ?>