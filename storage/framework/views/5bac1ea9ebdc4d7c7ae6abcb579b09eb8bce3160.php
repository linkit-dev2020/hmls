<?php $__env->startSection('content'); ?>
    <style>
        section{
            text-align: center;
            margin-top:10%;
            margin-bottom: 10%;
        }

    </style>
    <section style="">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-lg-6 center-block">
                    <div class="card">
                        <div class="card-header" style="background-color: rgb(157,7,7);color: #ffffff!important;">
                            <h3 style="color:#fff;">خطأ</h3>
                        </div>
                        <div class="card-body">
                            لايمكنك الوصول الى هذه الصفحة حسابك غير مفعل , يرجى التواصل مع الادارة
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.nhome.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/front-end/nhome/wait.blade.php ENDPATH**/ ?>