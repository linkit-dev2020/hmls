<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/myBootstarp.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/comments.css')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaijaan&amp;subset=arabic" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
	<style>

/* page layout structure */
#w { display: block; width: 100%; margin: 0 auto; padding-top: 4px; }

#container {
  display: block;
  width: 100%;
  background: #fff;
  padding: 14px 20px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  -webkit-box-shadow: 1px 1px 1px rgba(0,0,0,0.3);
  -moz-box-shadow: 1px 1px 1px rgba(0,0,0,0.3);
  box-shadow: 1px 1px 1px rgba(0,0,0,0.3);
}


/* comments area */
#comments { display: block; }

#comments .cmmnt, ul .cmmnt, ul ul .cmmnt { display: block; position: relative; padding-left: 65px; border-top: 1px solid #ddd; }

#comments .cmmnt .avatar  { position: absolute; top: 8px; left: 0; }
#comments .cmmnt .avatar img {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-shadow: 1px 1px 2px rgba(0,0,0,0.44);
  -moz-box-shadow: 1px 1px 2px rgba(0,0,0,0.44);
  box-shadow: 1px 1px 2px rgba(0,0,0,0.44);
  -webkit-transition: all 0.4s linear;
  -moz-transition: all 0.4s linear;
  -ms-transition: all 0.4s linear;
  -o-transition: all 0.4s linear;
  transition: all 0.4s linear;
}

#comments .cmmnt .avatar a:hover img { opacity: 0.77; }

#comments .cmmnt .cmmnt-content { padding: 0px 3px; padding-bottom: 12px; padding-top: 8px; }

#comments .cmmnt .cmmnt-content header { font-size: 1.3em; display: block; margin-bottom: 8px; }
#comments .cmmnt .cmmnt-content header .pubdate { color: #777; }
#comments .cmmnt .cmmnt-content header .userlink { font-weight: bold; }

#comments .cmmnt .replies { margin-bottom: 7px; }

	</style>
    <?php echo $__env->yieldContent('styles'); ?>
  </head>

  <body>

    <?php echo $__env->make('admin.inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.layouts.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="main">
      <?php echo $__env->yieldContent('content'); ?>
    </div>


    <?php echo $__env->make('admin.layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- jQuery (Bootstrap JS plugins depend on it) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="<?php echo e(asset('js/myBootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('js/script.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
    	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script>
		$(document).ready( function () {
			$('#myTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            },
            'paging':false,
            'ordering':false,
            'responsive': true
        } );
		} );

        var frm=document.getElementsByTagName('form');
        for(var i =0 ;i<frm.length;i++)
        {
            var frid=frm[i].id;
            if(frid.toString().localeCompare("deleteForm")==0)
                frm[i].classList.add('deleteForm');
        }
        $(".deleteForm").on("submit", function(){
            return confirm("هل أنت متأكد؟");
        });

	</script>
  <script>
      function openNav() {
          document.getElementById("side-section").style.width = "250px";
          //document.getElementById("main").style.marginLeft = "250px";
      }

      /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
      function closeNav() {
          document.getElementById("side-section").style.width = "0";
          //document.getElementById("main").style.marginLeft = "0";
      }


      fillSubjects();
  </script>
  </body>
</html>
<?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>