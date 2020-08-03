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
      <div class="col-lg-12">
        <div class="card color-grey">
          <div class="card-header">تعديل المادة التدريسية <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

              <form action="<?php echo e(route('lesson.update', ['lesson' => $lesson->id])); ?>" enctype="multipart/form-data" method="POST">
                    <?php echo csrf_field(); ?>

                     <?php echo method_field('PUT'); ?>


                <div class="form-group">
                  <label for="title"><h5>الدرس :</h5></label>
                  <input type="text" class="form-control" id="title" name="title" required value="<?php echo e($lesson->title); ?>">
                </div>
                <div class="form-group">
                  <label for="intro"><h5>المقدمة :</h5></label>
                  <textarea class="form-control" id="intro" name="intro" rows="3" required><?php echo e($lesson->intro); ?></textarea>
                    <label for="order"><h5>الترتيب</h5></label>
                    <input type="number" class="form-control" id="order" name="order"  min="1" max="9999999" value="<?php echo e($lesson->order_num); ?>" placeholder="ترتيب الدرس ضمن الوحدة">
                </div>
                <div class="form-group">
                    <h3>التبعية </h3>
                    <h5>يرجى عدم التغيير في حال رغبتك بالاحتفاظ بالتبعية القديمة

                    </h5>
                    <a class="btn btn-primary" id="change" onclick="showClass()">  تغيير </a>
                    <br>
                    <script>
                        function showClass()
                        {
                            $('.taClass').css('display','block');
                            $('#class_id').css('display','block');
                        }
                    </script>

                    <label for="class_id" class="taClass" style="display: none;">
                        الصف
                    </label>
                    <select class="form-control form-control-select mt-3" id="class_id" onchange="fillSubjects()" style="display: none;">
                        <option value="none"> - </option>
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
                  <select class="form-control form-control-select mt-3" id="unit_id" name="unit_id" style="display: none;">
                          <option value="-1" selected> - </option>
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
                <div class="form-group">
                  <label for="type">الدورة الدراسية:</label>
                  <select class="form-control form-control-select mt-3" name="course_id">
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($course->id); ?>"><?php echo e($course->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                <div class="form-group">

                       <div class="form-group">
  <label for="deneme_type">النوع الحالي
  &#8195; <?php echo e($lesson->type); ?>

  <br>
   الرابط <br>
  <?php echo e($lesson->url1); ?><br></label>


                  <select class="form-control form-control-select mt-3" name="type" id="lesson_type">
                  <option selected value="none">-- اختر النوع --</option>
                   <option value="video">فيديو</option>
                   <option value="image">صورة</option>
                   <option value="url">URL</option>
                   <option value="pdf">pdf</option>
                   <option value="word">word</option>
                  </select>
                </div>

                <div class="form-group"  id="lesson_file" style="display: none;">
                  <label for="">ملف الدرس  :</label>
                  <div class="input-group mt-3">
                    <div class="custom-file">
                      <input id="fileField" type="file" class="custom-file-input imageField" name="src">
                      <label class="custom-file-label imageFieldLabel" for="fileFeild">اختر ملف
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
                  <input type="text" class="form-control" id="embadedCode" name="embadedCode_src" placeholder="رابط الفديو">
                </div>


                <div class="radioG">
                  <h5>تفعيل الدرس  :</h5>
                  <div class="radio">
                    <input type="radio" name="active" value="1" <?php echo e($lesson->active ? "checked" : ""); ?>>
                    <label>مفعل</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" value="0" <?php echo e(!$lesson->active ? "checked" : ""); ?>>
                    <label>غير مفعل</label>
                  </div>
                </div>

                  <button type="submit" class="btn btn-success button1"> تعديل </button>

                <a href="<?php echo e(route('lesson.index')); ?>" class="btn btn-default" style="margin-right:5px">إلغاء</a>

                </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/lessons/edit.blade.php ENDPATH**/ ?>