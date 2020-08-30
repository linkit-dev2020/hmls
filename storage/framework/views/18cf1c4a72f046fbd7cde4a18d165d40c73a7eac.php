<?php $__env->startSection('content'); ?>

<div id="content">
  <?php if(Auth::user()->hasAnyRole([0,1])): ?>
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة البرامج</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="<?php echo e(route('class.create')); ?>" class="btn btn-success custom-but BP" >إضافة صف <div><i class="fa fa-plus-square" aria-hidden="true"></i></div></a>
      </div>
    </div>
  </div>
  <?php elseif(Auth::user()->hasAnyRole([2,3])): ?>
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-8">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i>  البرامج الدراسية  </small></h1>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <div id="table" class="row">
    <div class="col-lg-12 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> البرامج الدراسية</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr>
                <th>البرنامج الدراسي</th>
                <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                <th>المجانية</th>
                <?php endif; ?>
                <th>عرض</th>
                <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                <th>تعديل</th>

                <th>حذف</th>
                  <th> الترتيب </th>
                  <th> تاريخ الاضافة </th>
                  <th> تاريخ التعديل </th>
                <?php endif; ?>

              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($class->name); ?></td>
                <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                <?php if($class->free): ?>
                <td>مجاني</td>
                <?php elseif(!$class->free): ?>
                <td>غير مجاني</td>
                <?php endif; ?>
                <?php endif; ?>
                <td>
                  <div class="operations show">
                    <a href="<?php echo e(route('class.show', $class)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                <td>
                  <div class="operations update">
                    <a href="<?php echo e(route('class.edit', $class)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>


                <td>
                  <div class="operations delete">
                    <form action="<?php echo e(route('class.destroy',['class' => $class->id])); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">
                      <button id="del<?php echo e($class->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;"  id="a<?php echo e($class->id); ?>" onclick="$('#del<?php echo e($class->id); ?>').click()"  >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </a>
                    </form>
                  </div>
                </td>
                  <td><?php echo e($class->order_num); ?></td>
                  <td><?php echo e($class->created_at); ?></td>
                  <td><?php echo e($class->updated_at); ?></td>
                <?php endif; ?>

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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/classes/index.blade.php ENDPATH**/ ?>