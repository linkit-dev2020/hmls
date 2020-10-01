<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo e($subject->name); ?></title>
    <!-- Bootstrap core CSS-->
    <link href="<?php echo e(asset('vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.css')); ?>" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('css/sb-admin.css')); ?>" rel="stylesheet">
    <style>
        .dropdown-menu-center {
            left: 60% !important;
            right: auto !important;
            text-align: center !important;
            transform: translate(-60%, 0) !important;
        }
    </style>
</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="">HLMS</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">

        </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell fa-fw"></i>
                <span class="badge badge-danger" style="right: 20px">
                    <?php
                        if(Auth::user()->unreadNotifications!=null)
                            echo Auth::user()->unreadNotifications->count();
                        else
                            echo 0;
                    ?>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="alertsDropdown">
                <?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="dropdown-item" dir="rtl" href="<?php echo e($notf['data']['url']); ?>"><?php echo e($notf['data']['data']); ?> <i class="fa fa-star fa-fw"></i></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="dropdown-divider"></div>
                <?php $__currentLoopData = Auth::user()->readNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="dropdown-item" dir="rtl" href="<?php echo e($notf['data']['url']); ?>"><?php echo e($notf['data']['data']); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/clearNotf">تعليم الكل كمقروء</a>
            </div>
        </li>

        <li class="nav-item">
            <a href="/" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="الرئيسية"><i class="fa fa-home"></i></a>
        </li>

        <li class="nav-item mx-1">
            <a class="nav-link" href="/stdsh" data-toggle="tooltip" data-placement="bottom" title="حسابي">
                <i class="fa fa-user fa-fw"></i>
            </a>
        </li>
    </ul>

</nav>

<div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <?php $__currentLoopData = $subject->units->sortBy('order_num'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item dropdown" style="word-break: break-all!important;width:100%;">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-folder"></i>
                <span><?php echo e($unit->title); ?></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown"  style="word-wrap: break-word;">
                <?php $__currentLoopData = $unit->lessons->sortBy('order_num'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $less): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a  style="  word-break: break-all!important;width:100%;" class="nav-link" href="/stdsh/show/<?php echo e($subject->id); ?>/<?php echo e($unit->id); ?>/<?php echo e($less->id); ?>"><strong class="dropdown-header" style="display:inline!important;"><?php echo e($less->title); ?></strong></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-folder"></i>
                    <span>الاختبارات</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown"  >
                    <?php $__currentLoopData = $subject->tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $less): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <a href="/stdsh/showtest/<?php echo e($subject->id); ?>/test/<?php echo e($less->id); ?>"><strong class="dropdown-header" style="  word-wrap: break-word;"><?php echo e($less->title); ?></strong></a>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </li>
            <li class="nav-item">
                <a href="/chats/<?php echo e($subject->id); ?>" >المحادثات</a>
            </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#"><?php echo e($subject->name); ?></a>
                </li>
                <li class="breadcrumb-item active"></li>
            </ol>

            <!-- Area Chart Example-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-book"></i>
                    <?php if(isset($lesson)): ?>
                    <?php echo e($lesson->title); ?>

                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <div class="card-footer small text-muted"></div>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span></span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
<!-- Page level plugin JavaScript-->
<!-- Custom scripts for all pages-->
<script src="<?php echo e(asset('js/sb-admin.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<!-- Demo scripts for this page-->
<?php echo $__env->yieldContent('js'); ?>
</body>

</html>
<?php /**PATH D:\work\hmls\resources\views/stdashboard/master2.blade.php ENDPATH**/ ?>