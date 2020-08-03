<?php $__env->startSection('content'); ?>



    <div id="content">

        <div class="header-card table-cards color-grey">
            <div class="row">
                <div class="col-lg-4">
                    <div class="content-header">
                        <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> احصائيات الطلبات</small></h1>
                    </div>
                </div>

            </div>
        </div>

        <div id="table" class="row">
            <div class="col-lg-8">
                <div class="card table-cards color-grey">
                    <div class="card-body">
                        <div class="content-header">
                            <h2>
                                <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> طلبات الصفوف</small>
                            </h2>
                        </div>
                        <table class="table table-bordered table-hover table-width">
                            <thead>
                            <tr>
                                <th>اسم الطالب </th>
                                <th>اسم الصف</th>
                                <th>تاريخ القبول</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $requestsClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($request->student->username); ?></td>

                                    <td><?php echo e($request->class->name); ?></td>
                                    <td><?php echo e($request->updated_at); ?></td>


                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="table" class="row">
            <div class="col-lg-8">
                <div class="card table-cards color-grey">
                    <div class="card-body">
                        <div class="content-header">
                            <h2>
                                <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> طلبات الدورات</small>
                            </h2>
                        </div>
                        <table class="table table-bordered table-hover table-width">
                            <thead>
                            <tr>
                                <th>اسم الطالب </th>
                                <th>اسم الدورة</th>
                                <th>تاريخ القبول</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $requestsCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($request->student->username); ?></td>

                                    <td><?php echo e($request->course->title); ?></td>

                                    <td><?php echo e($request->updated_at); ?></td>


                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/requests/getAllRequests.blade.php ENDPATH**/ ?>