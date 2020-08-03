<?php $__env->startSection('content'); ?>

<div id="content">
  <?php if(Auth::user()->hasAnyRole([0,1])): ?>

    <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="content-header" style="background-image: url(<?php echo e(Storage::url($subject->cover)); ?>);background-size: cover;width: 100%;height: 500px">
         <center><img src="" style="width:100%;max-width:600px;" /></center>
        </div>
      </div>
	</div>
	</div>
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-5">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة مادة <?php echo e($subject->name); ?> ل <?php echo e($subject->class->name); ?></small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <?php if(!$subject->active): ?>
        <form action="<?php echo e(route('subject.activate', $subject)); ?>" method="POST" id="makeSubjectActivate" style="display:inline; margin-right:10px;">
          <?php echo csrf_field(); ?>

          <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makeSubjectActivate').submit();"> اجعل المادة مفعلة </a>
          </form>
          <?php else: ?>
          <form action="<?php echo e(route('subject.deactivate', $subject)); ?>" method="POST" id="makeSubjectDeactivate" style="display:inline; margin-right:10px;">
            <?php echo csrf_field(); ?>

            <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makeSubjectDeactivate').submit();"> اجعل المادة غير مفعلة</a>
        </form>
        <?php endif; ?>
      </div>
      <div class="col-lg-2">
        <!-- <a href="/classes/<?php echo e($subject->class->id); ?>/units/create?selectedsubject=<?php echo e($subject->id); ?>" class="btn btn-success button-margin-header custom-but" style="margin-right: 22px" >إضافة وحدة
         -->
         <a href="/units/create?selectedsubject=<?php echo e($subject->id); ?>" class="btn btn-success button-margin-header custom-but" style="margin-right: 22px" >إضافة وحدة

         <i class="fa fa-plus" aria-hidden="true" style="font-size:16px"></i>
        </a>
      </div>
      <div class="col-lg-3">
        <a href="<?php echo e(route('subject.index')); ?>" class="btn btn-primary button-margin-header custom-but pull-left" > إدارة كافة المواد
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div>
    </div>
  </div>
  <?php elseif(Auth::user()->hasAnyRole([2,3])): ?>
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> محتوى مادة <?php echo e($subject->name); ?> ل <?php echo e($subject->class->name); ?></small></h1>
        </div>
      </div>
      <div class="col-lg-6">
        <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
        <a href="<?php echo e(route('subject.index')); ?>" class="btn btn-primary button-margin-header custom-but pull-left" > العودة
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
        <?php endif; ?>
          <?php if(Auth::user()->hasAnyRole([3])): ?>
        <a href="<?php echo e(route('class.myclasses')); ?>" class="btn btn-primary button-margin-header custom-but pull-left" > العودة
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
            <?php endif; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
    <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
    <div id="table" class="row">
      <div class="card-deck">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card color-grey">
            <div class="card-body">
              <div class="card-header">اضافة اختبار للمادة</div>

              <form action="<?php echo e(route('subject.attachTest', ['subject' => $subject->id])); ?>" enctype="multipart/form-data" method="POST">
                <?php echo csrf_field(); ?>


                <div class="form-group">
                  <label for="lesson">اختر الاختبار :</label>
                  <select class="form-control form-control-select mt-3" id="test" name="test">
                    <option selected>-- اختر اختبار  --</option>

                    <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                      <option value="<?php echo e($test->id); ?>"><?php echo e($test->title); ?></option>


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
<?php endif; ?>

    <div id="table" class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
        <div class="card table-cards color-grey">
          <div class="card-body">
            <div class="content-header">
              <h2>
                <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الاختبارات المعتمدة ضمن <?php echo e($subject->name); ?></small>
              </h2>
            </div><span>
            </span><table class="table table-bordered table-hover table-width">
              <thead>
              <tr>
                <th>عنوان الاختبار</th>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                <th>التفعيل</th>
                <?php endif; ?>
                <th>العرض</th>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                <th>التعديل</th>
                <th>الحذف</th>
                <?php endif; ?>
                <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1)): ?>
                <th>فصل عن المادة</th>
                 <?php endif; ?>
              </tr>
              </thead>
              <tbody>
              <?php $__currentLoopData = $subjectTests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if($test->active === 0 && Auth::user()->hasRole(3)): ?>
                <?php else: ?>
                  <tr>
                    <td><?php echo e($test->title); ?></td>
                    <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                    <td class="operations">
                      <?php if($test->active): ?>
                        <form action="<?php echo e(route('test.deactivate', $test)); ?>" method="POST" id="activateForm">
                          <?php echo csrf_field(); ?>

                          <button id="<?php echo e($test->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                          <a herf="javascript:;" class="" onclick="$('#<?php echo e($test->id+1); ?>').click();" >
                            <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                          </a>
                        </form>
                      <?php else: ?>
                        <form action="<?php echo e(route('test.activate', $test)); ?>" method="POST" id="activateForm">
                          <?php echo csrf_field(); ?>

                          <button id="<?php echo e($test->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                          <a herf="javascript:;" class="" onclick="$('#<?php echo e($test->id); ?>').click();" >
                            <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                          </a>
                        </form>
                      <?php endif; ?>
                    </td>
                    <?php endif; ?>
                    <td>
                      <div class="operations show">
                        <a href="<?php echo e(route('test.show', $test)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                      </div>
                    </td>
                    <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                      <td>
                        <div class="operations update">
                          <a href="<?php echo e(route('test.edit', $test)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                        </div>
                      </td>
                      <td>
                        <div class="operations delete">
                          <form action="<?php echo e(route('test.destroy', $test)); ?>" method="POST" id="deleteForm">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="_method" value="DELETE">
                            <button id="<?php echo e($test->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                            <a herf="javascript:;" class="" onclick="$('#<?php echo e($test->id); ?>').click();" >
                              <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                            </a>
                          </form>

                        </div>
                      </td>
                      
                          {{--<?php  $test = DB::table('subject_test')->where('subject_id', $subject->id)->first(); ?>--}}
                          {{--<?php  if(!is_null($test)): ?>--}}
                        
                          
                            

                            
                            
                              
                            
                          
                        
                          {{--<?php  endif; ?>--}}
                      
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



    <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الوحدات الدراسية ضمن مادة ال <?php echo e($subject->name); ?></small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>اسم الوحدة</th>
                <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                <th>التفعيل</th>
                <?php endif; ?>
                <th>عدد دروس الوحدة</th>
                <th>الصف</th>
                <th>الترتيب</th>
                <th>العرض</th>
                <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                <th>التعديل</th>
                <th>الحذف</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $subject->units->sortBy('order_num'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($unit->title); ?></td>
                <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                <td class="operations">
                  <?php if($unit->active): ?>
                  <form action="<?php echo e(route('unit.deactivate', $unit)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="dect<?php echo e($unit->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#dect<?php echo e($unit->id); ?>').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php else: ?>
                  <form action="<?php echo e(route('unit.activate', $unit)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="act<?php echo e($unit->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#act<?php echo e($unit->id); ?>').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php endif; ?>
                </td>
                <?php endif; ?>
                <td><?php echo $unit->lessons->count() ; ?></td>
                <td><?php echo e($unit->subject->class->name); ?></td>
                <th><?php echo e($unit->order_num); ?></th>
                <td>
                  <div class="operations show">
                    <a href="<?php echo e(route('unit.show', $unit)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                <td>
                  <div class="operations update">
                    <a href="<?php echo e(route('unit.edit', $unit)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                <div class="operations delete">
                    <form action="<?php echo e(route('unit.destroy',['unit' => $unit->id])); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">
                      <button id="del<?php echo e($unit->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#del<?php echo e($unit->id); ?>').click();" >
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

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>مدرسوا المادة</small>
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
              <?php $__currentLoopData = $teachersSubject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacherSubject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($teacherSubject->username); ?></td>


                <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                <td>
                  <div class="operations delete">
                    <form action="<?php echo e(route('subject.deleteteacher',['subject' => $subject->id, 'teacher_id'=>$teacherSubject->id])); ?>" method="POST" id="deleteForm">
                       <?php echo csrf_field(); ?>


                      <button id="delteacher<?php echo e($subject->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#delteacher<?php echo e($subject->id); ?>').click();" >
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


  <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) ): ?>
  <div id="table2" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> إضافة مدرس لهذه المادة</small>
            </h2>
          </div>

          <form action="<?php echo e(route('subject.addteacher',$subject)); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="form-group">
              <label for="addteacher">اختر مدرس لاضافته الى هذه المادة :</label>
              <select class="form-control form-control-select mt-3" id="addteacher" name="teacher">
                <option selected>-- اختر مدّرس --</option>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/subjects/show.blade.php ENDPATH**/ ?>