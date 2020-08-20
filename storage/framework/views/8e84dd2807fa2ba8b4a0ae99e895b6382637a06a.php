<div id="main">
    <div id="content">
  <div class="header-card table-cards color-grey">
      <div class="row">
        <div class="col-lg-4">
          <div class="content-header">
          <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> لوحة التحكم</small></h1>
          </div>
        </div>
      </div>
    </div>





    <div id="table" class="row">
    <div class="col-lg-12">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> لوحة التحكم</small>
            </h2>
            <h4><span style="color: #AC282F"><?php echo e(Auth::user()->username); ?></span> ، اهلا بك في لوحة تحكم الحساب</h4>
          </div>
          
        </div>
      </div>
    </div>
  </div>









<!--
        <div class="row">
          <div class="card-deck">
            <div class="col-lg-3">
              <a href="">
                <div class="card color-p1">
                  <div class="card-body text-center">
                    <p class="card-text">المشرفين</p>
                    <img src="imgs/classroom.png" class="myicon">
                  </div>
                </div>
              </a>
              
            </div>
            <div class="col-lg-3">
              <div class="card color-p2">
                <div class="card-body text-center">
                  <p class="card-text">المعلمين</p>
                  <img src="imgs/classroom.png" class="myicon">
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card color-p3">
                <div class="card-body text-center">
                  <p class="card-text">الطلاب</p>
                  <img src="imgs/classroom.png" class="myicon">
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card bg-aqua">
                <div class="card-body text-center">
                  <p class="card-text">الصفوف</p>
                  <img src="imgs/classroom.png" class="myicon">
                </div>
              </div>
            </div>


          </div>
        </div>

        <div class="row">
          <div class="card-deck">
            
            <div class="col-lg-3">
              <div class="card bg-green">
                <div class="card-body text-center">
                  <p class="card-text">المواد</p>
                  <img src="imgs/classroom.png" class="myicon">
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card bg-yellow">
                <div class="card-body text-center">
                  <p class="card-text">الدورات</p>
                  <img src="imgs/classroom.png" class="myicon">
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card bg-red">
                <div class="card-body text-center">
                  <p class="card-text">الوحدات الدرسية</p>
                  <img src="imgs/classroom.png" class="myicon">
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card color-p4">
                <div class="card-body text-center">
                  <p class="card-text">الدروس</p>
                  <img src="imgs/classroom.png" class="myicon">
                </div>
              </div>
            </div>

          </div>
        </div>

    </div>-->
</div>
</div>


<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/layouts/partials/index.blade.php ENDPATH**/ ?>