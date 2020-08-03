<?php 
    $array = explode('/', $deneme->src);
    $file_name = $array[2];
?>



<?php $__env->startSection('content'); ?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الدينيمي</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        
      </div>
      <div class="col-lg-6">
        <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary button-margin-header custom-but pull-left" > العودة 
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div> 
    </div>
  </div>
        
  <div id="table" class="row">
    <div class="col-lg-8">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
              <h2>
                <small>
                  <i class="fa fa-picture-o" aria-hidden="true" style="font-size:24px;"></i>
                  <span style="direction:ltr; display: table-cell;"> <?php echo e($deneme->title); ?></span>
                </small>
              </h2>
          </div>
          <?php if($deneme->type === 'image'): ?>
          <img src="<?php echo e($deneme->src); ?>" alt="Picture" width="80%" height="60%">
          <?php elseif($deneme->type === 'video'): ?>
           <?php echo $deneme->src; ?>

          <?php endif; ?>
          <div  class="border-padding">
            <table class="show-table">
              <thead>
                  <tr>
                      <th><span class="border-padding">بعض المعلومات عن الدينيمي</span></th>
                      <th></th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>العنوان</td>
                      <td>:</td>
                      <td style="direction:ltr;"><?php echo e($deneme->title); ?></td>
                  </tr>
                  <tr>
                      <td>الصف</td>
                      <td>:</td>
                      <td><?php echo e($deneme->class->name); ?></td>
                  </tr>
                  <tr>
                      <td>الفصل</td>
                      <td>:</td>
                      <td><?php echo e($deneme->term === 1 ? $terms[0] : $terms[1]); ?><td>
                  </tr>
                  <tr>
                      <td>النوع</td>
                      <td>:</td>
                      <td><?php echo e($deneme->type); ?><td>
                  </tr>
                  <!--<tr>
                      <td>الفعالية</td>
                      <td>:</td>
                      <td><?php echo e($deneme->active ? $active[0] : $active[1]); ?><td>
                  </tr> -->
              </tbody>
            </table>
          </div>
            <?php if(Auth::user()->hasAnyRole([0,1,2])): ?>
          <form action="<?php echo e(route('deneme.destroy',['carousel' => $deneme->id])); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">    
                      <button class=" btn btn-danger custom-but">حذف الدينيمي</button>
              
          </form>


                <div id="table" class="row">
                    <div class="card-deck">
                        <div class="col-lg-6">
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
                                                <option  selected value="App\Deneme">دنيمي</option>
                                            </select>
                                        </div>
                                        <div class="form-group" >
                                            <label for="attachmentable_idField">تابع ل :</label>
                                            <select  class="form-control form-control-select mt-3" id="attachmentable_idField"
                                                     name="attachmentable_id" >
                                                <option selected value="<?php echo e($deneme->id); ?>"><?php echo e($deneme->title); ?></option>
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
                  
<?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/denemes/show.blade.php ENDPATH**/ ?>