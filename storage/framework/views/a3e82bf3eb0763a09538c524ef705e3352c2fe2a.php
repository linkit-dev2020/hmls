
<header id="main-header">
  <nav id="header-nav" class="navbar navbar-default">
    <div class="navbar-header">

      <a class="navbar-brand" href="/">

      </a>

    </div>
    <a class="logout" href="<?php echo e(route('logout')); ?>"
         onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                                        <?php echo e(__('تسجيل الخروج')); ?>

    </a>
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
      <?php echo csrf_field(); ?>
    </form>
  </nav>


</header>

<?php /**PATH D:\work\hmls\resources\views/admin/layouts/partials/header.blade.php ENDPATH**/ ?>