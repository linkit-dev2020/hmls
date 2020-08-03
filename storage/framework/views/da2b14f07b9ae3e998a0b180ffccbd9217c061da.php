<?php $__env->startSection('content'); ?>

<div id="content">

<div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المستخدمين</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-success custom-but BP" >إضافة مستخدم <div><i class="fa fa-plus-square" aria-hidden="true"></i></div></a>
      </div>
    </div>
  </div>

<?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
  <div id="table" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 ">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الطلاب</small>
            </h2>
              <form class="form-inline">
                <select class="form-control form-control-select" onchange="FillStudent()" id="clss">
                    <option value="0">جميع الطلاب</option>
                    <?php $__currentLoopData = \App\ClassRoom::all()->sortBy('order_num'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </form>
              <script>
                  function FillStudent()
                  {
                      let cid=document.getElementById('clss').value;
                      $.ajax({
                              url:'students/class/'+cid,
                              success:function(e)
                              {
                                  $('#contenttable').html(e);
                                  $('#myTable').DataTable().reload();
                              }

                          }
                      );
                  }
              </script>
              <br>
          </div>
          <table id="myTable" class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>اسم المستخدم</th>
                <th>الحالة</th>
                
                <th>رقم الكملك  </th>
                <th>رقم الهاتف</th>
                <!-- <th>تاريخ الإضافة</th> -->
                <th>عرض </th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody id="contenttable">
            <?php $__currentLoopData = $students->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="">
                    <td><?php echo e($student->username); ?></td>
                    <td class="operations">
                        <?php if($student->active): ?>
                            <form action="<?php echo e(route('users.deactivate', $student)); ?>" method="POST" id="activateForm">
                                <?php echo csrf_field(); ?>

                                <button id="<?php echo e($student->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                <a herf="javascript:;" class="" onclick="$('#<?php echo e($student->id+1); ?>').click();" >
                                    <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                                </a>
                            </form>
                        <?php else: ?>
                            <form action="<?php echo e(route('users.activate', $student)); ?>" method="POST" id="activateForm">
                                <?php echo csrf_field(); ?>

                                <button id="<?php echo e($student->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                <a herf="javascript:;" class="" onclick="$('#<?php echo e($student->id); ?>').click();" >
                                    <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                                </a>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($student->tc); ?></td>

                    <td><?php echo e($student->phone); ?></td>
                    <!-- <td><?php echo e($student->created_at); ?></td>-->
                    <td>
                        <div class="operations show">
                            <a href="<?php echo e(route('users.show', $student)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                        </div>
                    </td>
                    <td>
                        <div class="operations update">
                            <a href="<?php echo e(route('users.edit', $student)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                        </div>
                    </td>
                    <td>
                        <div class="operations delete">
                            <form action="<?php echo e(route('users.destroy',['user' => $student->id])); ?>" method="POST" id="deleteForm">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="_method" value="DELETE">
                                <button id="del<?php echo e($student->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                <a herf="javascript:;" class="" onclick="$('#del<?php echo e($student->id); ?>').click();" >
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
  <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/users/indexstudent.blade.php ENDPATH**/ ?>