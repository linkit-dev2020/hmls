<?php $__env->startSection('content'); ?>

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدروس </small></h1>
        </div>
      </div>

      <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
      <div class="col-lg-2">
        <?php if(!$lesson->active): ?>
        <form action="<?php echo e(route('lesson.activate', $lesson)); ?>" method="POST" id="makelessonActivate" style="display:inline; margin-right:10px;">
          <?php echo csrf_field(); ?>

          <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makelessonActivate').submit();"> اجعل الدرس مفعل </a>
          </form>
          <?php else: ?>
          <form action="<?php echo e(route('lesson.deactivate', $lesson)); ?>" method="POST" id="makelessonDeactivate" style="display:inline; margin-right:10px;">
            <?php echo csrf_field(); ?>

            <a href="#" class="btn btn-success button-margin-header custom-but" onclick="document.getElementById('makelessonDeactivate').submit();"> اجعل الدرس غير مفعل</a>
        </form>
        <?php endif; ?>
      </div>
        <div class="col-lg-6">
          <a href="<?php echo e(route('lesson.index')); ?>" class="btn btn-primary button-margin-header custom-but pull-left" >العودة
            <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
          </a>
        </div>
       <?php endif; ?> ;
      <?php if(Auth::user()->hasAnyRole([3])): ?>
      <div class="col-lg-6">
        <a href="javascript:history.back()" class="btn btn-primary button-margin-header custom-but pull-left" >العودة
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div>
        <?php endif; ?>
    </div>
  </div>

  <?php if($lesson->type === 'video'): ?>
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> فيديو الدرس</small>
            </h2>
          </div>

          <!-- <video width="520" height="440" controls>
            <source src="<?php echo e($lesson->src); ?>" type="video/mp4">
          Your browser does not support the video tag.
          </video> -->

          <?php echo $lesson->src; ?>


        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> معلومات الدرس</small>
            </h2>
          </div>

          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>اسم الدرس</th>
                <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
                <th>التفعيل</th>
                <?php endif; ?>
                <th>المقدمة</th>
                <?php if($lesson->type === 'image' || $lesson->type === 'pdf' || $lesson->type === 'word'): ?>
                <th>رابط الدرس</th>
                <?php elseif($lesson->type === 'url'): ?>
                <th>عنوان موقع الفيديو</th>
                <?php endif; ?>
                <?php if(Auth::user()->hasRole(3)): ?><th>تقيم الدرس</th><?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <tr>
               <td><?php echo e($lesson->title); ?></td>
                <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
               <td>
               <?php if($lesson->active): ?>
                  <form action="<?php echo e(route('lesson.deactivate', $lesson)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($lesson->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($lesson->id+1); ?>').click();" >
                      <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php else: ?>
                  <form action="<?php echo e(route('lesson.activate', $lesson)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($lesson->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($lesson->id); ?>').click();" >
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                  </form>
                  <?php endif; ?>
               </td>
                <?php endif; ?>
               <td><?php echo e($lesson->intro); ?></td>
               <?php if($lesson->type === 'image' || $lesson->type === 'pdf' || $lesson->type === 'word'): ?>
               <td><a href="<?php echo e($lesson->src); ?>">تحميل الدرس</a></td>
               <?php elseif($lesson->type === 'url'): ?>
               <td><a href="<?php echo e($lesson->src); ?> " target="_blank">الأنتقال إلى موقع الدرس </a></td>
               <?php endif; ?>
               <?php if(Auth::user()->hasRole(3)): ?>
               <td>
                <?php if($studentEvaluation === null): ?>
                <form action="<?php echo e(route('evaluation.store', $lesson)); ?>" method="POST">
                      <?php echo csrf_field(); ?>

                  <div class="rate">
                    <input type="radio" id="star5" name="value" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="value" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="value" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="value" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="value" value="1" />
                    <label for="star1" title="text">1 star</label>
                    <input type="hidden" id="lesson_id" name="lesson_id" value="<?php echo e($lesson->id); ?>" />
                    <input type="hidden" id="lesson_id" name="student_id" value="<?php echo e(Auth::user()->id); ?>" />
                    <button class="btn btn-sm btn-success">تأكيد</button>
                  </div>
                </form>
                <?php elseif($studentEvaluation != null): ?>
                <form action="<?php echo e(route('evaluation.update', $studentEvaluation)); ?>" method="POST">
                      <?php echo csrf_field(); ?>

                  <div class="rate">
                    <input type="radio" id="star5" name="value" value="5" <?php echo e($studentEvaluation->value === 5 ? 'checked' : ''); ?> />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="value" value="4" <?php echo e($studentEvaluation->value === 4 ? 'checked' : ''); ?> />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="value" value="3" <?php echo e($studentEvaluation->value === 3 ? 'checked' : ''); ?> />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="value" value="2" <?php echo e($studentEvaluation->value === 2 ? 'checked' : ''); ?> />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="value" value="1" <?php echo e($studentEvaluation->value === 1 ? 'checked' : ''); ?> />
                    <label for="star1" title="text">1 star</label>
                    <button class="btn btn-sm btn-success">تأكيد</button>
                  </div>
                </form>
                <?php endif; ?>
              </td>
              <?php endif; ?>
              </tr>
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
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>تعليقات الدرس</small>
            </h2>
          </div>
			<div id="w" dir="rtl">
			<div id="container">
			  <ul id="comments">
						<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!isset($comment->commenter)): ?> <?php continue; ?>
                            <?php endif; ?>
						<?php if($comment->parent>0): ?> <?php continue; ?>
						<?php endif; ?>
						<li class="cmmnt">
						  <div class="avatar"><a href="javascript:void(0);">
							<?php if($comment->commenter_type=="admin"): ?>
								<img src="<?php echo e(Storage::url('avatars/admin.png')); ?>" width="55" height="55" alt="">
							<?php endif; ?>
							<?php if($comment->commenter_type=="student"): ?>
								<img src="<?php echo e(Storage::url('avatars/user.png')); ?>" width="55" height="55" alt="">
							<?php endif; ?>
							<?php if($comment->commenter_type=="teacher"): ?>
								<img src="<?php echo e(Storage::url('avatars/teacher.png')); ?>" width="55" height="55" alt="">
							<?php endif; ?>
							<?php if($comment->commenter_type=="manager"): ?>
								<img src="<?php echo e(Storage::url('avatars/manager.png')); ?>" width="55" height="55" alt="">
							<?php endif; ?>
						  </a></div>
						  <div class="cmmnt-content">
							<header style="text-align:left!important">
								<a href="javascript:void(0);" class="userlink"><?php echo e($comment->commenter->username); ?></a>
							</header>
							<p><?php echo e($comment->content); ?></p>
							<?php if($comment->commenter_id === Auth::user()->id || Auth::user()->hasAnyRole([0,1])): ?>
								<div class="operations delete" style="position:absolute!important;top:7%;right:5px;">
								<form class="form-inline" action="<?php echo e(route('comment.destroy',['comment' => $comment->id])); ?>" method="POST" id="deleteForm">
								   <?php echo csrf_field(); ?>

								  <input type="hidden" name="_method" Value="delete">
								  <input type="submit" class="btn btn-danger" value="X">
								</form>
							  </div>
						    <?php endif; ?>
						  </div>

						  <ul class="replies">
							<?php $__currentLoopData = $comment->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($rep->commenter==null): ?> <?php continue; ?>;
                                <?php endif; ?>
							<li class="cmmnt">
							  <div class="avatar"><a href="javascript:void(0);">
								<?php if($rep->commenter_type=="admin"): ?>
									<img src="<?php echo e(Storage::url('avatars/admin.png')); ?>" width="55" height="55" alt="">
								<?php endif; ?>
								<?php if($rep->commenter_type=="student"): ?>
									<img src="<?php echo e(Storage::url('avatars/user.png')); ?>" width="55" height="55" alt="">
								<?php endif; ?>
								<?php if($rep->commenter_type=="teacher"): ?>
									<img src="<?php echo e(Storage::url('avatars/teacher.png')); ?>" width="55" height="55" alt="">
								<?php endif; ?>
								<?php if($rep->commenter_type=="manager"): ?>
									<img src="<?php echo e(Storage::url('avatars/manager.png')); ?>" width="55" height="55" alt="">
								<?php endif; ?>
							  </a></div>
							  <div class="cmmnt-content">
								<header style="text-align:left!important">
									<a href="javascript:void(0);" class="userlink"><?php echo e($rep->commenter->username); ?></a>
								</header>
								<p><?php echo e($rep->content); ?></p>
								<?php if($rep->commenter_id === Auth::user()->id || Auth::user()->hasAnyRole([0,1])): ?>
									<div class="operations delete" style="position:absolute!important;top:7%;right:5px;">
									<form action="<?php echo e(route('comment.destroy',['comment' => $comment->id])); ?>" method="POST" id="deleteForm">
									   <?php echo csrf_field(); ?>

									  <input type="hidden" name="_method" Value="delete">
									  <input type="submit" class="btn btn-danger" value="x" style="font-size:10px;">
									</form>
								  </div>
								<?php endif; ?>
							  </div>
							</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  </ul>

						  <form action="<?php echo e(route('lesson.addcomment', $lesson)); ?>" class="form-inline" method="POST"  style="display:inline; margin-right:10px;">
							<?php echo csrf_field(); ?>

							<div class="form-group">
								<input class="form-control" type="text" size="40" name="content"/>
								<input type="hidden" name="commid" value="<?php echo e($comment->id); ?>" />
							</div>
							<input type="submit" class="btn btn-success " value="رد"/>
						   </form>

						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  </ul>
			</div>
		  </div>
          <form action="<?php echo e(route('lesson.addcomment', $lesson)); ?>" method="POST"  style="display:inline; margin-right:10px;">
            <?php echo csrf_field(); ?>

            <div class="form-group">
            <label for="comment"> اضافة تعليق</label>
            <input class="form-control" type="text" name="content">
            <input type="hidden" name="commid" value="0">
            </div>
            <input type="submit" class="btn btn-success myhover" value="اضافة تعليق">
        </form>


        </div>
      </div>
    </div>

  </div>

  <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>تقيم الدرس من قبل الطلاب</small>
            </h2>
          </div>

          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>الطالب</th>
                <th>التقيم</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
               <td><?php echo e($rating->student->full_name); ?></td>
               <td>
                <div class="rating">
                  <?php for($i =0; $i < $rating->value; $i++): ?>
                  <span class="fa fa-star checked"></span>
                  <?php endfor; ?>
                  <?php for($i =$rating->value; $i < 5; $i++): ?>
                  <span class="fa fa-star"></span>
                  <?php endfor; ?>
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
  <?php endif; ?>

  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>مدرسوا الدرس</small>
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
              <?php $__currentLoopData = $teachersLesson; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacherLesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($teacherLesson->username); ?></td>


                <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                <td>
                  <div class="operations delete">
                    <form action="<?php echo e(route('lesson.deleteteacher',['lesson' => $lesson->id, 'teacher_id'=>$teacherLesson->id])); ?>" method="POST" id="deleteForm">
                       <?php echo csrf_field(); ?>


                      <button id="<?php echo e($lesson->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#<?php echo e($lesson->id); ?>').click();" >
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
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> إضافة مدرس لهذا الدرس</small>
            </h2>
          </div>

          <form action="<?php echo e(route('lesson.addteacher',$lesson)); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="form-group">
              <label for="addteacher">اختر مدرس لاضافته الى هذا الدرس :</label>
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

  <div id="table" class="row">
    <div class="card-deck">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card color-gray">
                <div class="card-body">
                    <div class="card-header">
                        المرفقات
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

  <div id="table" class="row">
    <div class="card-deck">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة مرفق</div>

            <form action="<?php echo e(route('attachment.store')); ?>" enctype="multipart/form-data" method="POST">
              <?php echo csrf_field(); ?>

              <div class="form-group">
                <label for="namne"><h5>اسم المرفق :</h5></label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="اسم المرفق الجديد">
              </div>
              <div class="form-group" >
                <label for="attachmentable_typeField">مرتبط مع :</label>
                <select   class="form-control form-control-select mt-3" id="attachmentable_typeField" name="attachmentable_type">
                  <option selected value="App\Lesson">درس</option>
                </select>
              </div>
              <div class="form-group" >
                <label for="attachmentable_idField">تابع ل :</label>
                <select  class="form-control form-control-select mt-3" id="attachmentable_idField"
                        name="attachmentable_id" >
                  <option selected value="<?php echo e($lesson->id); ?>"><?php echo e($lesson->title); ?></option>
                </select>
              </div>
              <div class="form-group">
                <label for="typeField">نوع المرفق :</label>
                <select class="form-control form-control-select mt-3" id="typeField" name="type">
                  <option selected>-- اختر النوع --</option>
                  <option value="file">ملف</option>
                  <option value="image">صورة</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">ملف المرفق :</label>
                <div class="input-group mt-3">
                  <div class="custom-file">
                    <input id="imageField" type="file" class="custom-file-input imageField" name="src">
                    <label class="custom-file-label imageFieldLabel" for="imageFeild">اختر ملف المرفق
                      <i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>
                    </label>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-success myhover">إضافة</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/lessons/show.blade.php ENDPATH**/ ?>