<?php $__env->startSection('content'); ?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الإختبارات </small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل الاختبار </div>
            <div class="card-body">

              <form action="<?php echo e(route('test.update', $test)); ?>" enctype="multipart/form-data" method="POST">
                      <?php echo csrf_field(); ?>

                      <?php echo method_field('PUT'); ?>

                <div class="form-group">
                  <label for="test"><h5>اسم الإختبار :</h5></label>
                  <input type="text" class="form-control" id="test" name="title" value="<?php echo e($test->title); ?>" required placeholder="عنوان الإختبار الجديد"> 
                </div>
                <div class="form-group">
                  <label for="termField">الفصل الدراسي :</label>
                  <select class="form-control form-control-select mt-3" id="termField" name="term">
                    <option value="1" <?php echo e($test->term === 1 ? "selected" : ""); ?>>الفصل الأول</option>
                    <option value="2" <?php echo e($test->term === 2 ? "selected" : ""); ?>>الفصل الثاني</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="subtestField">الأمتحان :</label>
                  <select class="form-control form-control-select mt-3" id="subtestField" name="sub_test">
                    <option value="1" <?php echo e($test->sub_test === 1 ? "selected" : ""); ?>>الأمتحان الأول</option>
                    <option value="2" <?php echo e($test->sub_test === 2 ? "selected" : ""); ?>>الأمتحان الثاني</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="typeField">نوع ملف الأختبار :</label>
                  <select class="form-control form-control-select mt-3" id="test_typeField" name="type" onchange="ShitFunction()">
                    <option value="image" <?php echo e($test->type === 'image' ? "selected" : ""); ?>>صورة</option>
                    <option value="video" <?php echo e($test->type === 'video' ? "selected" : ""); ?>>فيديو</option>
                    <option value="word" <?php echo e($test->type === 'word' ? "selected" : ""); ?>>ملف Word</option>
                    <option value="pdf" <?php echo e($test->type === 'pdf' ? "selected" : ""); ?>>ملف PDF</option>
                  </select>
                </div>


                  <script>
                      ShitFunction();
                      function ShitFunction()
                      {
                          var val=document.getElementById('test_typeField').value;
                          switch (val) {
                              case 'video':
                                  document.getElementById('embaded_code').style.display='block';
                                  document.getElementById('test_file').style.display='none';
                                  document.getElementById('test_url').style.display='none';

                                  break;
                              case 'url':
                                  document.getElementById('test_url').style.display='block';
                                  document.getElementById('test_file').style.display='none';
                                  document.getElementById('embaded_code').style.display='none';
                                  break;
                              case 'image':
                                  document.getElementById('test_file').style.display='block';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('test_url').style.display='none';

                                  break;
                              case 'pdf':
                                  document.getElementById('test_file').style.display='block';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('test_url').style.display='none';
                                  break;

                              case 'word':
                                  document.getElementById('test_file').style.display='block';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('test_url').style.display='none';
                                  break;

                              default:
                                  document.getElementById('test_file').style.display='none';
                                  document.getElementById('embaded_code').style.display='none';
                                  document.getElementById('test_url').style.display='none';
                          }


                      }
                  </script>
                <div class="form-group"  id="test_file" style="display: none;">
                  <label for="">ملف الاختبار  :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="fileField" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="fileFeild">اختر ملف
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group" id="test_url" style="display: none;">
                  <label for="urlField"><h5>ادخل ال URL :</h5></label>
                  <input type="url" class="form-control" id="urlField" name="url_src" placeholder="ادخل ال URL">
                </div>

                <div class="form-group" id="embaded_code" style="display: none;">
                  <label for="embadedCode"><h5>ادخل رابط الفديو :</h5></label>
                  <input type="text" class="form-control" id="embadedCode" name="embadedCode_src" placeholder="رابط الفديو">
                </div>


                

                <div class="form-group">
                  <label for="typeField">المادة الدراسية  :</label>
                  <select class="form-control form-control-select mt-3" id="typeField" name="subject_id">
                    <option selected>-- اختر مادة --</option>
                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->name); ?> التابعة لل <?php echo e($subject->class->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                <div class="radioG">
                  <h5>تفعيل هذا الأختبار :</h5>
                  <div class="radio">
                    <input type="radio" name="active" value="1" <?php echo e($test->active === 1 ? "checked" : ""); ?>>
                    <label>مفعل</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" value="0" <?php echo e($test->active === 0 ? "checked" : ""); ?>>
                    <label>غير مفعل</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-success myhover">تعديل</button>
                <a href="<?php echo e(route('test.index')); ?>" class="btn btn-default button2" style="margin-right:5px">إلغاء</a>
              </form>

          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/tests/edit.blade.php ENDPATH**/ ?>