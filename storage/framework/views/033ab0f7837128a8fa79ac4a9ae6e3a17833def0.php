
 	<div id="side-section">

      <ul id="side">
        <?php if(Auth::user()->hasRole(0)): ?>
        <li><a href="<?php echo e(route('users.indexmanager')); ?>">المشرفون <i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('users.indexteacher')); ?>">المعلمون<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('users.indexstudent')); ?>"> الطلاب<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('class.index')); ?>">التخصصات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('course.index')); ?>">الدورات المجانية<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('classrequest.index')); ?>">إدارة طلبات التخصصات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('notes.index')); ?>">الاعلانات<i class="fa fa-angle-double-left pull-left"></i></a></li>

        <?php endif; ?>
        <?php if(Auth::user()->hasRole(1)): ?>
        <li><a href="<?php echo e(route('users.indexteacher')); ?>">المعلمون<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('users.indexstudent')); ?>"> الطلاب<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('class.index')); ?>">التخصصات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('course.index')); ?>"> الدورات المجانية<i class="fa fa-angle-double-left pull-left"></i></a>
        <li><a href="<?php echo e(route('notes.index')); ?>">الاعلانات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <?php endif; ?>
        <?php if(Auth::user()->hasRole(2)): ?>
        <li><a href="<?php echo e(route('subject.index')); ?>">المواد<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('course.index')); ?>">الدورات المجانية<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('unit.index')); ?>">الوحدات الدرسية<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('lesson.index')); ?>">الدروس<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('test.index')); ?>">الوظائف<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('attachment.index')); ?>">المرفقات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="/gettest">تقييم الوظائف<i class="fa fa-angle-double-left pull-left"></i></a></li>

        <?php endif; ?>
        <?php if(Auth::user()->hasRole(3)): ?>
        <li><a href="<?php echo e(route('class.index')); ?>">الصفوف<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="<?php echo e(route('course.index')); ?>">الدورات المجانية<i class="fa fa-angle-double-left pull-left"></i></a></li>

        <li><a href="<?php echo e(route('class.myclasses')); ?>">صفوفي<i class="fa fa-angle-double-left pull-left"></i></a></li>
            <li><a href="<?php echo e(route('course.mycourses')); ?>">دوراتي<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <?php endif; ?>
      </ul>
    </div>

<?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/layouts/partials/sidebar.blade.php ENDPATH**/ ?>