<?php $__env->startSection('content'); ?>
    <?php if(isset($lesson)): ?>
    <style>

        /* New Comment panel style */


        .comment-wrapper .panel-body p{
            overflow-wrap: break-word;
        }


        .comment-wrapper .media-list .media img {
            width:100%px;
            height:64px;
            border:2px solid #e5e7e8;
        }

        .comment-wrapper .media-list .media {
            border-bottom:1px dashed #efefef;
            margin-bottom:25px;
        }
        .maincomm{
            background-color: #eee;
        }
        /* end of newcomment panel style */
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
    <?php if(isset($lesson)): ?>
        <div style="text-align: right">
            <h3>مقدمة</h3>
            <p>
                <?php echo $lesson->intro; ?>

            </p>
        </div>
        <div class="align-content-center" style="text-align: center!important;">
        <?php if($lesson->type=="image"): ?>
            <img src="<?php echo e(asset($lesson->src)); ?>" width="100%" />
        <?php elseif($lesson->type=="video"): ?>
            <?php echo $lesson->src; ?>

            <script>
                var ifr=document.getElementsByTagName("iframe");
                for(i=0;i<ifr.length;i++)
                {
                    ifr[i].style.width ='100%';
                    ifr[i].style.height ='400px';

                }
            </script>

        <?php elseif($lesson->type=='pdf'): ?>
            <a href="<?php echo e(asset($lesson->src)); ?>" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> تحميل </a>
        <?php elseif($lesson->type=='word'): ?>
            <a href="<?php echo e(asset($lesson->src)); ?>" class="btn btn-primary"><i class="fa fa-file-word-o"></i> تحميل </a>
        <?php elseif($lesson->type=='url'): ?>
            <a href="<?php echo e(asset($lesson->src)); ?>" class="btn btn-primary"><i class="fa fa-globe"></i> انتقال الى الدرس  </a>
        <?php endif; ?>
        </div>
        <br>

        <?php if($lesson->attachments!=null): ?>
            <h3 id="att_h" style="text-align: right!important;display: none;">مرفقات الدرس</h3>

            <ul class="list-group">
            <?php $__currentLoopData = $lesson->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <script>
                        document.getElementById("att_h").style.display='block';
                    </script>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="<?php echo e(asset($att->src)); ?>" ><?php echo e($att->name); ?></a>
                        <?php if($att->type=='pdf'): ?>
                            <span class="badge badge-primary badge-pill"><i class="fa fa-file-pdf-o"></i></span>
                        <?php elseif($att->type=='word'): ?>
                            <span class="badge badge-primary badge-pill"><i class="fa fa-file-word-o"></i></span>
                        <?php elseif($att->type=='url'): ?>
                            <span class="badge badge-primary badge-pill"><i class="fa fa-globe"></i></span>
                        <?php elseif($att->type=='video'): ?>
                            <span class="badge badge-primary badge-pill"><i class="fa fa-file-video-o"></i></span>
                        <?php elseif($att->type=='image'): ?>
                            <span class="badge badge-primary badge-pill"><i class="fa fa-file-image-o"></i></span>
                        <?php endif; ?>
                    </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    <?php else: ?>
        <img src="<?php echo e(Storage::url($subject->cover)); ?>" width="100%" />
    <?php endif; ?>

    <br><br>

    <h3 style="text-align: right;" id="comment_h" > التعليقات</h3>

    <form action="<?php echo e(route('lesson.addcomment', $lesson)); ?>" method="POST"  style="display:inline; margin-right:10px;">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="comment"> اضافة تعليق</label>
            <input class="form-control" type="text" name="content">
            <input type="hidden" name="commid" value="0">
        </div>
        <input type="submit" class="btn btn-success myhover" value="اضافة تعليق">
    </form>



        <br><br>
<div class="container">
    <div class="row bootstrap snippets" >
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="comment-wrapper">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        التعليقات
                    </div>
                    <div class="panel-body">
                        <ul class="media-list list-group">
                            <?php $__currentLoopData = $lesson->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($comment->parent>0): ?> <?php continue; ?>
                                <?php endif; ?>

                                <?php if($comment->commenter==null): ?> <?php continue; ?>
                                <?php endif; ?>
                                <li class="media list-item maincomm"  >
                                    <a href="#" class="pull-left">
                                        <?php if($comment->commenter_type=="admin"): ?>
                                            <img src="<?php echo e(Storage::url('avatars/admin.png')); ?>"  alt="">
                                        <?php endif; ?>
                                        <?php if($comment->commenter_type=="student"): ?>
                                            <img src="<?php echo e(Storage::url('avatars/user.png')); ?>"   alt="">
                                        <?php endif; ?>
                                        <?php if($comment->commenter_type=="teacher"): ?>
                                            <img src="<?php echo e(Storage::url('avatars/teacher.png')); ?>"  alt="">
                                        <?php endif; ?>
                                        <?php if($comment->commenter_type=="manager"): ?>
                                            <img src="<?php echo e(Storage::url('avatars/manager.png')); ?>"  alt="">
                                        <?php endif; ?>

                                    </a>
                                    <div class="media-body">
                                    <span class="text-muted pull-right">
                                        <a data-toggle="modal" data-target="#repmodal<?php echo e($comment->id); ?>"><i class="fa fa-reply"></i></a>
                                        <small class="text-muted">
                                            <?php if($comment->commenter_id == Auth::user()->id || Auth::user()->hasAnyRole([0,1])): ?>
                                                <div class="operations delete" style="">
                                            <form class="form-inline" action="<?php echo e(route('comment.destroy',['comment' => $comment->id])); ?>" method="POST" id="deleteForm">
                                                <?php echo csrf_field(); ?>

                                                <input type="hidden" name="_method" Value="delete">
                                                <input type="submit" class="btn btn-danger" value="X">
                                            </form>
                                                </div>
                                            <?php endif; ?>
                                        </small>
                                    </span>

                                        <strong class="text-success"><?php echo e($comment->commenter->username); ?></strong>
                                        <p>
                                            <?php echo e($comment->content); ?>

                                        </p>
                                    </div>
                                </li>

                                    <div class="modal" id="repmodal<?php echo e($comment->id); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title" style="text-align: right">رد</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('lesson.addcomment', $lesson)); ?>" style="text-align:center;" method="POST"  style="display:inline-block;;">
                                                        <?php echo csrf_field(); ?>

                                                        <div class="form-group">
                                                            <input class="form-control" type="text" size="40" name="content"/>
                                                            <input type="hidden" name="commid" value="<?php echo e($comment->id); ?>" />
                                                        </div>
                                                        <input type="submit" class="btn btn-success " value="رد"/>
                                                    </form>
                                                </div>

                                                <!-- Modal footer -->

                                            </div>
                                        </div>
                                    </div>

                                    <?php $__currentLoopData = $comment->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="media list-item" style="padding-left: 10%;">
                                        <a href="#" class="pull-left">
                                            <?php if($rep->commenter_type=="admin"): ?>
                                                <img src="<?php echo e(Storage::url('avatars/admin.png')); ?>"  alt="">
                                            <?php endif; ?>
                                            <?php if($rep->commenter_type=="student"): ?>
                                                <img src="<?php echo e(Storage::url('avatars/user.png')); ?>"   alt="">
                                            <?php endif; ?>
                                            <?php if($rep->commenter_type=="teacher"): ?>
                                                <img src="<?php echo e(Storage::url('avatars/teacher.png')); ?>"  alt="">
                                            <?php endif; ?>
                                            <?php if($rep->commenter_type=="manager"): ?>
                                                <img src="<?php echo e(Storage::url('avatars/manager.png')); ?>"  alt="">
                                            <?php endif; ?>

                                        </a>
                                        <div class="media-body">
                                        <span class="text-muted pull-right">

                                            <small class="text-muted">

                                                <?php if($rep->commenter_id === Auth::user()->id || Auth::user()->hasAnyRole([0,1])): ?>
                                                    <div class="operations delete" style="">

                                                        <form action="<?php echo e(route('comment.destroy',['comment' => $rep->id])); ?>" method="POST" id="deleteForm">
                                                            <?php echo csrf_field(); ?>

                                                            <input type="hidden" name="_method" Value="delete">
                                                            <input type="submit" class="btn btn-danger" value="X" style="font-size:10px;">
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            </small>
                                        </span>
                                            <strong class="text-success"><?php echo e($rep->commenter->username); ?></strong>
                                            <p>
                                                <?php echo e($rep->content); ?>

                                            </p>
                                        </div>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    <?php else: ?>
       <div style="text-align: center ">
           <h3 >
               اهلا بكم في <?php echo e($course->title); ?>

           </h3>
           <h5>
               يمكن اختيار الدروس اوالاختبارات من القائمة الجانبية
           </h5>
       </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('stdashboard.master3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/stdashboard/showCourse.blade.php ENDPATH**/ ?>