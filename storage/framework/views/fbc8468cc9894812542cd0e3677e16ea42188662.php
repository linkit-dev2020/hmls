<?php $__env->startSection('content'); ?>

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المواد الدراسية</small></h1>
        </div>
      </div>
    </div>
  </div>
  <div id="table" class="row">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">اضافة درس جديد <i class="fa fa-plus-square" aria-hidden="true"></i></div>

              <form action="<?php echo e(route('lesson.store')); ?>" enctype="multipart/form-data" method="POST" >
                      <?php echo csrf_field(); ?>


                <div class="form-group">
                  <label for="lesson"><h5>الدرس :</h5></label>
                  <input type="text" class="form-control" id="lesson" name="title" required placeholder="اسم الدرس الجديد">
                </div>

                <div class="form-group">
                  <label for="intro"><h5>المقدمة :</h5></label>
                  <input type="text" class="form-control" id="intro" name="intro" required placeholder="مقدمة الدرس">

                    <label for="order"><h5>الترتيب</h5></label>
                    <input type="number" class="form-control" id="order" value="1"  min="1" max="9999999" name="order"  placeholder="ترتيب الدرس ضمن الوحدة">
                </div>


                <?php if($selectedUnit === null && $selectedCourse === null): ?>
                <div class="form-group">
                    <script>
                        function showClass()
                        {
                            $('.taClass').css('display','block');
                            $('#class_id').css('display','block');
                        }
                    </script>

                    <label for="class_id" class="taClass" style="">
                        التبعية
                    </label>
                    <select class="form-control form-control-select mt-3" id="class_id" onchange="fillSubjects()" style="">
                        <option selected>الصف</option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <label for="subject_id" style="display: none;" class="taSub">
                        المادة
                    </label>

                    <select class="form-control form-control-select mt-3" id="subject_id" onchange="fillUnits()" style="display: none;">

                    </select>

                    <script>
                        var ch=false;
                        <?php if(!\Illuminate\Support\Facades\Auth::user()->hasAnyRole([0,1])): ?>
                            ch=true;
                        <?php endif; ?>
                        function  fillSubjects() {
                            var cid=document.getElementById('class_id').value;
                            console.log(cid);
                            var url="/api/getSubjects/"+cid;;
                            if(ch)
                                url="/api/getSubjects/"+cid+"/<?php echo e(\Illuminate\Support\Facades\Auth::user()->id); ?>";
                            $.ajax({
                                url:url,
                                success:function(e)
                                {
                                    let t='<option value="none"> - </option>';
                                    $('#subject_id').html(t+e);
                                    $('#subject_id').css('display','block');
                                    $('.taSub').css('display','block');
                                    console.log(e);


                                }
                            });
                        }

                        function fillUnits(){
                            var cid=document.getElementById('subject_id').value;
                            console.log(cid);
                            var url="/api/getUnits/"+cid;
                            $.ajax({
                                url:url,
                                success:function(e)
                                {
                                    let t='<option value="none"> - </option>';
                                    $('#unit_id').html(t+e);
                                    $('#unit_id').css('display','block');
                                    $('.taUn').css('display','block')
                                    console.log(e);

                                }
                            });
                        }
                    </script>

                    <label class="taUn" for="type" style="display: none;">الوحدة الدراسية:</label>
                    <select class="form-control form-control-select mt-3" id="unit_id"  name="unit_id" style="display: none;">
                        <option value="0" selected></option>
                    <!--  <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($unit->id); ?>">
                              الوحدة:
                              <?php echo e($unit->title); ?>

                            التابعة للمادة:
<?php if($unit->subject!=null): ?>
                            <?php echo e($unit->subject->name); ?>

                        <?php else: ?>
                            *
<?php endif; ?>
                            التابعة للصف :
<?php if($unit->subject->class!=null): ?>
                            <?php echo e($unit->subject->class->name); ?>

                        <?php else: ?>
                            *
<?php endif; ?>
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                    </select>
                </div>
                </div>
                  <?php elseif($selectedUnit != null): ?>
                  <div class="form-group">
                    <label for="classField">الوحدة الدراسية:</label>
                    <select class="form-control form-control-select mt-3" id="classField" name="unit_id" readonly>
                      <option value="<?php echo e($selectedUnit->id); ?>"><?php echo e($selectedUnit->title); ?></option>
                    </select>
                  </div>
                  <?php endif; ?>

                <?php if($selectedCourse === null && $selectedUnit === null): ?>
                <div class="form-group">
                    <label for="classField">الدورة الدراسية:</label>
                    <select class="form-control form-control-select mt-3" id="classField" name="course_id">
                      <option selected>-- اختر الدورة --</option>
                      <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($course->id); ?>"><?php echo e($course->title); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  <?php elseif($selectedCourse != null): ?>
                    <?php if($selectedUnit==null): ?>
                        <input type="hidden" value="0" name="unit_id"/>
                    <?php endif; ?>
                  <div class="form-group">
                    <label for="classField">الدورة الدراسية:</label>
                    <select class="form-control form-control-select mt-3" id="classField" name="course_id" readonly>
                      <option value="<?php echo e($selectedCourse->id); ?>"><?php echo e($selectedCourse->title); ?></option>
                    </select>

                </div>
                <?php endif; ?>
                <br>
                <div class="form-group">
                  <label for="type">نوع الدرس :</label>

                  <select class="form-control form-control-select mt-3" name="type" id="lesson_type">
                   <option selected id="defChoice">-- اختر النوع --</option>
                   <option value="video">فيديو</option>
                   <option value="image">صورة</option>
                   <option value="url">URL</option>
                   <option value="pdf">pdf</option>
                   <option value="word">word</option>
                  </select>
                </div>
                    <script>
                        document.getElementById('lesson_type').value='-- اختر النوع --';
                    </script>
                <div class="form-group" id="lesson_file" style="display: none;">
                  <label for="">ملف الدرس :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="lessonFile" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="lessonFile">اختر ملف الدرس
                        <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group" id="lesson_url" style="display: none;">
                  <label for="urlField"><h5>ادخل ال URL :</h5></label>
                  <input type="url" class="form-control" id="urlField" name="url_src" placeholder="ادخل ال URL">
                </div>

                <div class="form-group" id="embaded_code" style="display: none;">
                  <label for="embadedCode"><h5>ادخل رابط الفديو :</h5></label>
                  <input type="url" class="form-control" id="embadedCode" name="embadedCode_src" placeholder="رابط الفديو">
                  <label for="isLive"><h5>Live</h5></label>
                  <input type="checkbox" class="form-control" id="isLive" name="isLive"><br>
                  <label for="isLive"><h5>start</h5></label>
                  <input type="datetime" class="form-control" id="start" name="start"><br>
                </div>

                <div class="radioG">
                  <h5>تفعيل الدرس  :</h5>
                  <div class="radio">
                    <input type="radio" name="active" value="1" checked>
                    <label>مفعل</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" value="0">
                    <label>غير مفعل</label>
                  </div>
                </div>

                <button type="submit" class="btn btn-success button1">إضافة</button>
                <a href="<?php echo e(route('lesson.index')); ?>" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/lessons/create.blade.php ENDPATH**/ ?>