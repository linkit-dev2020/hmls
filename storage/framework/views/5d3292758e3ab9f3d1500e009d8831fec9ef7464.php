<?php 
    $array = explode('/', $advice->src);
    $file_name = $array[2];
?>


<?php $__env->startSection('content'); ?>

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة النصائح</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        
      </div>
      <div class="col-lg-6">
        <a href="<?php echo e(route('advice.index')); ?>" class="btn btn-primary button-margin-header custom-but pull-left" >ادارة النصائح  
          <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
        </a>
      </div> 
    </div>
  </div>

  <div id="table" class="row">
    <div class="col-lg-6">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>ملف النصيحة </small>
            </h2>
          </div>
           <?php if(  $advice->type == "video"): ?>
             
            
           
            
            
           
             <iframe  width="320" height="240" src="https://www.youtube.com/embed/<?php echo $src; ?>"></iframe>
        <?php elseif( $advice->type = "audio"): ?>
    
           <audio controls>
                     <source src= <?php echo $advice->src; ?> type="audio/ogg">
                     <source src= <?php echo $advice->src; ?> type="audio/mpeg">
                        Your browser does not support the audio element.
           </audio>
       
          <?php endif; ?>
         

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
                <small>
                  <i class="fa fa-file-archive-o" aria-hidden="true" style="font-size:24px;"></i>
                  <span style="direction:ltr; display: table-cell;"> <?php echo e($advice->title); ?></span>
                </small>
              </h2>
            </div>
          <div  class="border-padding">
              <h3>الدروس التي تتبع لها :</h3>
            <table class="show-table">
                <th>  اسم الصف </th>
              <tbody>
              <?php $__currentLoopData = $adviceClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td style="direction:ltr;"><?php echo e($class->name); ?></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>


            <div  class="border-padding">
                <h3>الدورات التي تتبع لها :</h3>
                <table class="show-table">
                    <th>اسم الدورة</th>
                    <tbody>
                    <?php $__currentLoopData = $adviceCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="direction:ltr;"><?php echo e($course->title); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
          
          <form action="<?php echo e(route('advice.destroy',['advice' => $advice])); ?>" method="POST" id="deleteForm">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_method" value="DELETE">    
                      <button class=" btn btn-danger custom-but">حذف الملف</button>     
          </form>       
                  
        </div>
      </div>
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/advices/show.blade.php ENDPATH**/ ?>