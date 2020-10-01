<?php $__env->startSection('content'); ?>
    <style>
        strong{
            color: red !important;
            text-align: right;
        }
        .form-control{
            height: calc(2.25rem + 2px)!important;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
    </style>

    <section class=""  style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=752&q=80); background-position: 0% center;font-family: Changa;background-size: cover">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6 py-5 px-md-5 " dir="rtl" style="">
                <div class="heading-section heading-section-white ftco-animate mb-5">
                    <h2 class="mb-4" style="text-align: right ;">تسجيل الدخول</h2>
                </div>
                <form action="<?php echo e(route('login')); ?>" method="POST" class=" ftco-animate">
                    <?php echo csrf_field(); ?>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" required placeholder="اسم المستخدم">

                        </div>
                    </div>
                    <div class="d-md-flex" style="color:#fff!important;text-align: right;">
                        <?php if($errors->has('username')): ?>
                            <div class="" role="">
                                <strong><?php echo e($errors->first('username')); ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <input type="password" class="form-control" required name="password" placeholder="كلمة المرور">
                            <?php if($errors->has('password')): ?>
                                <span class="" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>


                    </div>

                    <div class="d-md-flex">

                        <div class="form-group">
                            <a href="<?php echo e(route('password.request')); ?>"> <span style="color: #FFFFFF"> هل نسيت كلمة المرور؟</span></a><br>
                            <input class="form-check-input" type="hidden" name="remember" value="1" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                        </div>
                        <br>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group ml-md-12 ">
                            <input type="submit" value="دخول" class="btn btn-outline-secondary py-3 px-4" >
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>

<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center; font-size: x-large;"><?php echo e(__('تسجيل الدخول')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-left"><?php echo e(__('اسم المستخدم')); ?></label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control<?php echo e($errors->has('username') ? ' is-invalid' : ''); ?>" name="username" value="<?php echo e(old('username')); ?>" required autocomplete="username" autofocus>

                                <?php if($errors->has('username')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-left"><?php echo e(__('كلمة المرور')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required autocomplete="current-password">

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 m-o-m" style="margin-right: 33.3333333333%;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember" style="margin-right: 20px;">
                                        <?php echo e(__('تذكرني في المرة القادمة')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 m-o-m" style="margin-right: 33.3333333333%;">
                                <button type="submit" class="btn btn-success">
                                    <?php echo e(__('تسجيل الدخول')); ?>

                                </button>

                                <?php if(Route::has('password.request')): ?>
                                    <a class="btn btn-link forget-password" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('هل نسيت كلمة المرور الخاصة بك ؟')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    
</style>

-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.nhome.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\hmls\resources\views/auth/login.blade.php ENDPATH**/ ?>