<?php $__env->startSection('content'); ?>

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> ادارة المستخدمين</small></h1>
        </div>
      </div>
    </div>
  </div>
  <div id="table" class="row">
    <div class="card-deck">       
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">تعديل مستخدم <i class="fa fa-plus-square" aria-hidden="true"></i></div>
              
              <form action="<?php echo e(route('users.update',$user)); ?>" method="POST">
                      <?php echo csrf_field(); ?>


                <!-- <div class="form-group">
                  <label for="role">اختر نوع المستخدم :</label>
                  <select name="role" id="role" class="form-control">
                  <?php if(Auth::user()->hasRole(0)): ?>
                  <option value="0">مدير نظام</option>
                  <option value="1">مشرف</option>
                  <?php endif; ?>
                  <option value="2">مدرس</option>
                  <option selected value="3">طالب</option>
                  </select>
                </div> -->

                <div class="form-group">
                  <label for="username"><h5>اسم المستخدم :</h5></label>
                  <input type="text" class="form-control" id="username" name="username" required placeholder="اسم المستخدم" value="<?php echo e($user->username); ?>">
                </div>

                <div class="form-group">
                  <label for="password"><h5>كلمة المرور :</h5></label>
                  <input type="password" class="form-control" id="password" name="password" required placeholder="كلمة المرور" value="<?php echo e($user->password); ?>">
                </div>

         

                <div class="form-group">
                  <label for="tc"><h5>رقم الكملك:</h5></label>
                  <input type="text" class="form-control" id="tc" name="tc" required placeholder="tc"value="<?php echo e($user->tc); ?>">
                </div>

                <!-- <div class="form-group">
                  <label for="email"><h5>البريد الالكتروني :</h5></label>
                  <input type="text" class="form-control" id="email" name="email" required placeholder="البريد" value="<?php echo e($user->email); ?>">
                </div> -->

                <div class="form-group">
                  <label for="phone"><h5>رقم الهاتف:</h5></label>
                  <input type="text" class="form-control" id="phone" name="phone" required placeholder="رقم الهاتف"value="<?php echo e($user->phone); ?>">
                </div>

                <!--<div class="radioG">-->
                <!--  <h5>تفعيل المستخدم  :</h5>-->
                <!--  <div class="radio">-->
                <!--    <input type="radio" name="active" value="1" checked>-->
                <!--    <label>مفعل</label>-->
                <!--  </div>-->
                <!--  <div class="radio">-->
                <!--    <input type="radio" name="active" value="0">-->
                <!--    <label>غير مفعل</label>-->
                <!--  </div>-->
                <!--</div>-->

                
                
                <input type="hidden" name="_method" value="put">
                <button type="submit" class="btn btn-success button1">تعديل</button>
                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>