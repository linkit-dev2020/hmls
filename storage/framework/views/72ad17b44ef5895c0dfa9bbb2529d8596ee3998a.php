<?php $__env->startSection('content'); ?>


<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-6">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المرفقات</small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل المرفق <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

              <form action="<?php echo e(route('attachment.update', ['attachment' => $attachment->id])); ?>" enctype="multipart/form-data" method="POST">
                      <?php echo csrf_field(); ?>

                      <?php echo method_field('PUT'); ?>

                <div class="form-group">
                  <label for="namne"><h5>اسم المرفق :</h5></label>
                  <input type="text" class="form-control" id="name" name="name" required value="<?php echo e($attachment->name); ?>" placeholder="اسم المرفق الجديد"> 
                </div>
                <div class="form-group">
                  <label for="attachmentable_typeField">مرتبط مع :</label>
                  <select class="form-control form-control-select mt-3" id="attachmentable_typeField" name="attachmentable_type">
                    <option value="App\Lesson" <?php echo e($attachment->attachmentable_type === 'App\Lesson' ? "selected" : ""); ?>>درس</option>
                    <option value="App\Deneme" <?php echo e($attachment->attachmentable_type === 'App\Deneme' ? "selected" : ""); ?>>دنيمي</option>
                    <option value="App\test" <?php echo e($attachment->attachmentable_type === 'App\Test' ? "selected" : ""); ?>>اختبار</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="attachmentable_idField">تابع ل :</label>
                  <select class="form-control form-control-select mt-3" id="attachmentable_idField" name="attachmentable_id">
                    <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($lesson->id); ?>" <?php echo e($attachment->attachmentable_id === $lesson->id ? "selected" : ""); ?>><?php echo e($lesson->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $denemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deneme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($deneme->id); ?>" <?php echo e($attachment->attachmentable_id === $deneme->id ? "selected" : ""); ?>><?php echo e($deneme->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($test->id); ?>" <?php echo e($attachment->attachmentable_id === $test->id ? "selected" : ""); ?>><?php echo e($test->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <!--<div class="form-group">-->
                <!--  <label for="typeField">نوع المرفق :</label>-->
                <!--  <select class="form-control form-control-select mt-3" id="typeField" name="type">-->
                <!--    <option selected>-- اختر النوع --</option>-->
                <!--    <option value="file" <?php echo e($attachment->type === 'file' ? "selected" : ""); ?>>ملف</option>-->
                <!--    <option value="image" <?php echo e($attachment->type === 'image' ? "selected" : ""); ?>>صورة</option>-->
                <!--  </select>-->
                <!--</div>-->
                <!--<div class="form-group">-->
                <!--  <label for="">ملف المرفق :</label>-->
                <!--  <div class="input-group mt-3">-->
                <!--    <div class="custom-file">-->
                <!--      <input id="imageField" type="file" class="custom-file-input imageField" name="src">-->
                <!--      <label class="custom-file-label imageFieldLabel" for="imageFeild">اختر ملف المرفق -->
                <!--        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>-->
                <!--      </label>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
                
                   <div class="form-group">
                  <label for="type">اختر نوع المرفق</label>
                  <select class="form-control form-control-select mt-3" name="type" onchange="ShitFunction()" id="att_typeField">
                  <option selected>-- اختر النوع --</option>
                   <option value="video">فيديو</option>
                   <option value="image">صورة</option>
                   <option value="url">URL</option>
                   <option value="pdf">pdf</option>
                   <option value="word">word</option>
                  </select>
                </div>

                  <script>
                      ShitFunction();
                      function ShitFunction()
                      {
                          var val=document.getElementById('att_typeField').value;
                          switch (val) {
                              case 'video':
                                  document.getElementById('embaded_code').style.display='block';
                                  document.getElementById('att_file').style.display='none';
                                  document.getElementById('att_url').style.display='none';

                                  break;
                              case 'url':
                                  document.getElementById('att_url').style.display='block';
                                  document.getElementById('att_file').style.display='none';
                                  document.getElementById('embaded_code').style.display='none';
                                  break;
                              case 'image':
                                  document.getElementById('att_file').style.display='block';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('att_url').style.display='none';

                                  break;
                              case 'pdf':
                                  document.getElementById('att_file').style.display='block';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('att_url').style.display='none';
                                  break;

                              case 'word':
                                  document.getElementById('att_file').style.display='block';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('att_url').style.display='none';
                                  break;

                              default:
                                  document.getElementById('att_file').style.display='none';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('att_url').style.display='none';
                          }

                      }
                  </script>
                       <div class="form-group"  id="att_file" style="display: none;">
                  <label for="">ملف المرفق  :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="fileField" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="fileFeild">اختر ملف
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group" id="att_url" style="display: none;">
                  <label for="urlField"><h5>ادخل ال URL :</h5></label>
                  <input type="url" class="form-control" id="urlField" name="url_src" placeholder="ادخل ال URL">
                </div>

                <div class="form-group" id="embaded_code" style="display: none;">
                  <label for="embadedCode"><h5>ادخل رابط الفديو :</h5></label>
                  <input type="text" class="form-control" id="embadedCode" name="embadedCode_src" placeholder="رابط الفديو">
                </div>


                <button type="submit" class="btn btn-success button1">تعديل</button>
                <a href="<?php echo e(route('attachment.index')); ?>" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/attachments/edit.blade.php ENDPATH**/ ?>