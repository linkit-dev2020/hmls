<?php $__env->startSection('content'); ?>



<div id ="content">



    <div id="table" class="row" >

        <div class="col-lg-12 col-md-12 col-sm-12 ">

            <div class="card">

                <div class="card-header" style="text-align: right; font-size: x-large;"><?php echo e(__('معلومات المستخدم')); ?></div>



                <div class="card-body">

                    



                        <div class= "row ">

                            <h2> اسم المستخدم:<?php echo e($user->username); ?></h2>

                        </div>



                        <div class= "row">

                            <h2>رقم الكملك:<?php echo e($user->tc); ?></h2>

                        </div>



                        <div class= "row">

                            <h2>رقم الهاتف:<?php echo e($user->phone); ?></h2>

                        </div>



                        <div class= "row">

                        <?php if($user->hasRole(0)): ?>

                            <h2>نوع المستخدم:مدير نظام</h2>

                            <?php elseif($user->hasRole(1)): ?>

                            <h2>نوع المستخدم:مشرف </h2>

                            <?php elseif($user->hasRole(2)): ?>

                            <h2>نوع المستخدم:مدرس </h2>

                            <?php elseif($user->hasRole(3)): ?>

                            <h2>نوع المستخدم:طالب </h2>

                            <?php endif; ?>

                        </div>



                        

                </div>

            </div>

        </div>

    </div>



    <?php if($user->hasAnyRole([2,3])): ?>

    <div id="table" class="row">

        <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="card table-cards color-grey">

            <div class="card-body">

            <div class="content-header">

                <h2>

                <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الصفوف المرتبط بها</small>

                </h2>

            </div>

            <table class="table table-bordered table-hover table-width">

                <thead>

                <tr> 

                    <th>اسم الصف</th>

                    

                    <th>فصل المستخدم عن الصف</th>

                </tr>

                </thead>

                <tbody>



                <?php if($user->hasRole(3)): ?>

                <?php $__currentLoopData = $user->classess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>

                    <td><?php echo e($class->name); ?></td>

                    <td>

                    

                    <div class="operations delete">

                        

                        <form action="<?php echo e(route('class.deletestudent',['class' => $class->id])); ?>" method="POST" id="deleteForm">

                        <?php echo csrf_field(); ?>


                        

                        <input type="hidden" name="student_id" value="<?php echo e($user->id); ?>">     

                        <input type="submit" class="btn btn-danger" value ="فصل">

                        </form> 

                         

                             

                        

                    </div>

                    </td>

                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php elseif($user->hasRole(2)): ?>

                <?php $__currentLoopData = $user->classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>

                    <td><?php echo e($class->name); ?></td>

                    <td>

                    

                    <div class="operations delete">



                    <form action="<?php echo e(route('class.deleteteacher',['class' => $class->id])); ?>" method="POST" id="deleteForm">

                        <?php echo csrf_field(); ?>


                        

                        <input type="hidden" name="teacher_id" value="<?php echo e($user->id); ?>">    

                        <input type="submit" class="btn btn-danger" value ="فصل">

                        </form>
                    </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

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

                <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدورات المرتبط بها</small>

                </h2>

            </div>

            <table class="table table-bordered table-hover table-width">

                <thead>

                <tr> 

                    <th>اسم الدورة</th>

                    

                    <th>فصل المستخدم عن الدورة</th>

                </tr>

                </thead>

                <tbody>

                <?php if($user->hasRole(2)): ?>

                <?php $__currentLoopData = $user->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>

                    <td><?php echo e($course->title); ?></td>

                    

                    

                    <td>

                    <div class="operations delete">

                         

                        <form action="<?php echo e(route('course.deleteteacher',['course' => $course->id])); ?>" method="POST" id="deleteForm">

                        <?php echo csrf_field(); ?>


                        

                        <input type="hidden" name="teacher_id" value="<?php echo e($user->id); ?>">    

                        <input type="submit" class="btn btn-danger" value ="فصل">

                        </form>     

                        

                    </div>

                    </td>

                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>

                <?php $__currentLoopData = $user->coursess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>

                    <td><?php echo e($course->title); ?></td>

                    

                    

                    <td>

                    <div class="operations delete">

                         

                        <form action="<?php echo e(route('course.deletestudent',['course' => $course->id])); ?>" method="POST" id="deleteForm">

                        <?php echo csrf_field(); ?>


                        

                        <input type="hidden" name="student_id" value="<?php echo e($user->id); ?>">    

                        <input type="submit" class="btn btn-danger" value ="فصل">

                        </form>     

                        

                    </div>

                    </td>

                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

                </tbody>

            </table>

            </div>

        </div>

        </div>

    </div>



    <?php endif; ?>


    <?php if($user->hasAnyRole([3])): ?>
    <div id="table" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card table-card color-grey">
                <div class="card-header" style="text-align: right">
                    اضافة الطالب الى الصف :
                </div>

                <div class="card-body">
                    <form  method="post" action="<?php echo e(route('class.addstudent',['sid'=>$user->id])); ?>">
                        <?php echo csrf_field(); ?>
                        <label for="class_id">الصف :</label>
                        <input type="hidden" name="sid" value="<?php echo e($user->id); ?>" />
                        <select id="class_id" class="form-control form-control-select" name="cid">
                            <?php $__currentLoopData = \App\ClassRoom::all()->sortBy('order_num'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <input class="btn btn-primary" value="اضافة" type="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="table" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card table-card color-grey">
                <div class="card-header" style="text-align: right">
                    اضافة الطالب الى دورة :
                </div>

                <div class="card-body">
                    <form  method="post" action="<?php echo e(route('course.addstudent',['sid'=>$user->id])); ?>">
                        <?php echo csrf_field(); ?>
                        <label for="class_id">الدورة :</label>
                        <input type="hidden" name="sid" value="<?php echo e($user->id); ?>" />
                        <select id="class_id" class="form-control form-control-select" name="cid">
                            <?php $__currentLoopData = \App\Course::all()->sortBy('order_num'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($class->id); ?>"><?php echo e($class->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <input class="btn btn-primary" value="اضافة" type="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/users/show.blade.php ENDPATH**/ ?>