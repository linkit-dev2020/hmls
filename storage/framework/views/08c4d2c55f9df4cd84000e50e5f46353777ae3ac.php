<?php $__env->startSection('content'); ?>
    <div id="content" class="container">
        <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
            <div class="header-card table-cards color-grey">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="content-header">
                            <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدورات الدراسية</small></h1>
                        </div>
                    </div>
                    <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                        <div class="col-lg-2">
                            <?php if(!$course->active): ?>
                                <form action="<?php echo e(route('course.activate', $course)); ?>" method="POST" id="makeCourseActive" style="display:inline; margin-right:10px;">
                                    <?php echo csrf_field(); ?>

                                    <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makeCourseActive').submit();">تفعيل الدورة</a>
                                </form>
                            <?php else: ?>
                                <form action="<?php echo e(route('course.deactivate', $course)); ?>" method="POST" id="makeCourseDeactive" style="display:inline; margin-right:10px;">
                                    <?php echo csrf_field(); ?>

                                    <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makeCourseDeactive').submit();">إلغاء تفعيل الدورة</a>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="col-lg-2">
                        <a href="/lessons/create?selectedcourse=<?php echo e($course->id); ?>" class="btn btn-success button-margin-header" style="margin-right: 22px" >إضافة درس
                            <i class="fa fa-plus" aria-hidden="true" style="font-size:16px"></i>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="<?php echo e(route('course.index')); ?>" class="btn btn-primary button-margin-header custom-but pull-left" > إدارة كافة الدورات
                            <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php elseif(Auth::user()->hasAnyRole([3])): ?>
            <div class="header-card table-cards color-grey">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content-header">
                            <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> محتوى <?php echo e($course->title); ?></small></h1>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary button-margin-header custom-but pull-left" > العودة
                            <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <ul class="nav nav-tabs " style="margin-right: 15em;
    display: flex;
    align-items: center;">
        <li class="active"><a data-toggle="tab" href="#home">الدروس</a></li>
        <li><a data-toggle="tab" href="#menu1">المدرسون</a></li>
        <li><a data-toggle="tab" href="#menu2">النصائح</a></li>
        <?php if(Auth::user()->hasAnyRole([0,1])): ?>
        <li><a data-toggle="tab" href="#menu3">طلاب الدورة</a></li>
        <?php endif; ?>
    </ul>
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">

            <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                <div id="table" class="row">
                    <div class="card-deck">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card color-grey">
                                <div class="card-body">
                                    <div class="card-header">اضافة درس للدورة</div>

                                    <form action="<?php echo e(route('course.addlesson', ['course' => $course])); ?>"
                                          enctype="multipart/form-data" method="GET">
                                        <?php echo csrf_field(); ?>


                                        <div class="form-group">
                                            <label for="lesson">اختر الدرس :</label>
                                            <select class="form-control form-control-select mt-3" id="lesson" name="lesson">
                                                <option selected>-- اختر درس --</option>

                                                <?php $__currentLoopData = $Alllessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                                    <option value="<?php echo e($lesson->id); ?>"><?php echo e($lesson->title); ?></option>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </select>

                                        </div>

                                        <button type="submit" class="btn btn-success myhover">إضافة</button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?> ;


                <div id="table" class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
                        <div class="card table-cards color-grey">
                            <div class="card-body">
                                <div class="content-header">
                                    <h2>
                                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدروس المعتمدة ضمن <?php echo e($course->title); ?></small>
                                    </h2>
                                </div>
                                <table class="table table-bordered table-hover table-width">
                                    <thead>
                                    <tr>
                                        <th>عنوان الدرس</th>
                                        <th>نوع الملف</th>
                                        <th>العرض</th>
                                        <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                                            <th>التفعيل</th>
                                            <th>التعديل</th>
                                            <th>الحذف</th>

                                        <?php endif; ?>

                                        <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                                            <th>فصل عن الدورة</th>
                                        <?php endif; ?>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($lesson->active === 0 && Auth::user()->hasRole(3)): ?>

                                        <?php else: ?>
                                            <tr>
                                                <td><?php echo e($lesson->title); ?></td>
                                                <td><?php echo e($lesson->type); ?></td>
                                                <td>
                                                    <div class="operations show">
                                                        <a href="<?php echo e(route('lesson.show', $lesson)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                                                    </div>
                                                </td>
                                                <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                                                    <td class="operations">
                                                        <?php if($lesson->active): ?>
                                                            <form action="<?php echo e(route('lesson.deactivate', $lesson)); ?>" method="POST" id="activateForm">
                                                                <?php echo csrf_field(); ?>

                                                                <button id="dect<?php echo e($lesson->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                                                <a herf="javascript:;" class="" onclick="$('#dect<?php echo e($lesson->id); ?>').click();" >
                                                                    <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                                                                </a>
                                                            </form>
                                                        <?php else: ?>
                                                            <form action="<?php echo e(route('lesson.activate', $lesson)); ?>" method="POST" id="activateForm">
                                                                <?php echo csrf_field(); ?>

                                                                <button id="active<?php echo e($lesson->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                                                <a herf="javascript:;" class="" onclick="$('#active<?php echo e($lesson->id); ?>').click();" >
                                                                    <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                                                                </a>
                                                            </form>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td>
                                                        <div class="operations update">
                                                            <a href="<?php echo e(route('lesson.edit', $lesson)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="operations delete">
                                                            <form action="<?php echo e(route('lesson.destroy', $lesson)); ?>" method="POST" id="deleteForm">
                                                                <?php echo csrf_field(); ?>

                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button id="delete<?php echo e($lesson->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                                                <a herf="javascript:;" class="" onclick="$('#delete<?php echo e($lesson->id); ?>').click();" >
                                                                    <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                                                </a>
                                                            </form>

                                                        </div>
                                                    </td>
                                                    <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                                                    <td>
                                                        <div class="operations delete">
                                                            <form action="<?php echo e(route('course.deletelesson',['course' => $course->id])); ?>" method="POST" id="deleteForm">
                                                                <?php echo csrf_field(); ?>

                                                                <input type="hidden" id="lesson_id" name="lesson_id" value="<?php echo e($lesson->id); ?>" />
                                                                <button id="deat<?php echo e($course->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                                                <a herf="javascript:;" class="" onclick="$('deat#<?php echo e($course->id); ?>').click();" >
                                                                    <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div id="menu1" class="tab-pane fade">

            <div id="table" class="row">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="card table-cards color-grey">
                        <div class="card-body">
                            <div class="content-header">
                                <h2>
                                    <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>مدرسوا الدورة</small>
                                </h2>
                            </div>
                            <table class="table table-bordered table-hover table-width">
                                <thead>
                                <tr>
                                    <th>اسم المدرس</th>
                                    <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                                        <th>حذف</th>
                                    <?php endif; ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $teachersCourse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacherCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($teacherCourse->username); ?></td>


                                        <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                                            <td>
                                                <div class="operations delete">
                                                    <form action="<?php echo e(route('course.deleteteacher',['course' => $course->id, 'teacher_id'=>$teacherCourse->id])); ?>" method="POST" id="deleteForm">
                                                        <?php echo csrf_field(); ?>


                                                        <button id="<?php echo e($course->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                                        <a herf="javascript:;" class="" onclick="$('#<?php echo e($course->id); ?>').click();" >
                                                            <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                                        </a>
                                                    </form>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                <div id="table2" class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="card table-cards color-grey">
                            <div class="card-body">
                                <div class="content-header">
                                    <h2>
                                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> </small>
                                    </h2>
                                </div>

                                <form action="<?php echo e(route('course.addteacher',$course)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>

                                    <div class="form-group">
                                        <label for="addteacher">اختر مدرس لاضافته الى هذه الدورة</label>
                                        <select name="teacher" id="teacher" class="form-contorl form-control-select mt-3">
                                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->username); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-success button1" value="اضافة المدرس">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
        <div id="menu2" class="tab-pane fade">
            <?php if($course->advices->count()> 0 ): ?>
                <div id="table3" class="row">
                    <table class="col-lg-12 col-md-12 col-sm-12 col-lg-pull-2 table table-bordered table-hover table-width">
                        <thead>
                        <tr>
                            <th>اسم النصيحة</th>
                            <th>الملف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  foreach ($courseAdvices as $courseAdvice): ?>
                        <tr>
                            <td><?php echo e($courseAdvice->title); ?></td>
                            <td>

                                <?php if(  $courseAdvice->type == "video"): ?>
                                    
                                    
                                    
                                    
                                    
                                    <?php

                                    $src = '' ;
                                    if(strpos($courseAdvice->src, 'youtu.be')){
                                        $src=str_replace("/storage//youtu.be/","",$courseAdvice->src);
                                    }


                                    ?>

                                    <iframe  width="320" height="240" src="https://www.youtube.com/embed/<?php echo $src;?>"></iframe>
                                <?php elseif( $courseAdvice->type == "audio"): ?>

                                    <audio controls>
                                        <source src= <?php echo $courseAdvice->src; ?> type="audio/ogg">
                                        <source src= <?php echo $courseAdvice->src; ?> type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>

                                <?php endif; ?>
                            </td>


                        </tr>
                        <?php  endforeach;  ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        <?php if(Auth::user()->hasAnyRole([0,1])): ?>
		<!-- new tab -->
			 <div id="menu3" class="tab-pane fade">
            <div id="table" class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
                <div class="card table-cards color-grey">
                  <div class="card-body">
                    <div class="content-header">
                      <h2>
                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>طلاب الدورة</small>
                      </h2>
					  <form action="<?php echo e(route('course.deleteAllStudents',['course' => $course->id])); ?>" method="POST" id="deleteForm">
									<?php echo csrf_field(); ?>

									<input type="submit" class="btn btn-danger"  value="فصل جميع الطلاب" />
					   </form>
                    </div>
                    <table class="table table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th>اسم الطالب</th>
                        <th>فصل</th>
                      </tr>
                      </thead>
                      <tbody>

                      <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($st->full_name); ?></td>
                          <td>
                            <div class="operations delete">
								<form action="<?php echo e(route('course.deletestudent',['course' => $course->id])); ?>" method="POST" id="deleteForm">
									<?php echo csrf_field(); ?>

									<input type="hidden" name="student_id" value="<?php echo e($st->id); ?>">
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
        </div>
      </div>
		<!-- end -->
      <?php endif; ?>
    </div>









</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/courses/show.blade.php ENDPATH**/ ?>