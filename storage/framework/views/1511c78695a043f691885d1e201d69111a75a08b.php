<?php $__env->startSection('content'); ?>


<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المواد التدريسية</small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل المادة التدريسية <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

              <form action="<?php echo e(route('subject.update', ['subject' => $subject->id])); ?>" method="POST" enctype="multipart/form-data">
                      <?php echo csrf_field(); ?>

                      <?php echo method_field('PUT'); ?>

                <div class="form-group">
                  <label for="subject"><h5>المادة الدراسية :</h5></label>
                  <input type="text" class="form-control" id="subject" name="name" required value="<?php echo e($subject->name); ?>">


                    <label for="order"><h5>ترتيب المادة ضمن الصف </h5></label>
                    <input type="number" class="form-control" id="order" min="1" max="9999999"  name="order" required placeholder="ترتيب المادة ضمن الصف " value="<?php echo e($subject->order_num); ?>">
                </div>
                <div class="radioG">
                  <h5>تفعيل الدورة التدريسية :</h5>
                  <div class="radio">
                    <input type="radio" name="active" value="1" <?php echo e($subject->active ? "checked" : ""); ?>>
                    <label>مفعلة</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" value="0" <?php echo e(!$subject->active ? "checked" : ""); ?>>
                    <label>غير مفعلة</label>
                  </div>
                </div>
                   <div class="form-group">
                  <label for="classField"> الصف الدراسي الحالي  :   <?php echo e($subject->class->name); ?> </label>    
                  
                  
                  <select class="form-control form-control-select mt-3" id="classField" name="class_id">
                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($class->id); ?>" <?php echo e($class->id === $subject->class->id ? "selected" : ""); ?>><?php echo e($class->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                  </select>
                </div>
                <div class="radioG">
                  <h5>قابلية المادة للتنزيل :</h5>
                  <div class="radio">
                    <input type="radio" name="downloable" value="1" <?php echo e($subject->downloable ? "checked" : ""); ?>>
                    <label>قابلة</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="downloable" value="0" <?php echo e(!$subject->downloable ? "checked" : ""); ?>>
                    <label>غير قابلة</label>
                  </div>
                </div>
				
				<div class="form-group">

                  <label for="">صورة الغلاف :</label>

                  <div class="input-group mt-3">

                    <div class="custom-file">

                      <input id="imageField"  type="file" class="custom-file-input imageField" name="cover">

                      <label class="custom-file-label imageFieldLabel" for="imageFeild">اختر ملف الصورة 

                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>

                      </label>

                    </div>

                  </div>

                </div>

                <button type="submit" class="btn btn-success button1">تعديل</button>
                <a href="<?php echo e(route('subject.index')); ?>" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/subjects/edit.blade.php ENDPATH**/ ?>