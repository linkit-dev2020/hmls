<?php $__env->startSection('content'); ?>
    <div id="chat_container">
        <?php $__currentLoopData = $msg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($m->sender_id == Auth::user()->id): ?>
            <div class="send">
                <?php echo e(\App\User::find($m->sender_id)->fullname); ?>

                <span class="message badge badge-primary">
                    <?php echo e($m->msg); ?>

                </span>
            </div>
            <?php else: ?>
            <div class="recv">
                <?php echo e(\App\User::find($m->sender_id)->fullname); ?>

                <span class="message badge badge-primary">
                    <?php echo e($m->msg); ?>

                </span>
            </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <textarea class="msg" style="width: 100%" class="mt-5">

    </textarea>
    <button class="btn btn-primary" style="width:100%;" id="sendbtn">
        ارسال
    </button>
    <style>
        textarea{
            border:none;
            border-bottom: 1px solid #666;
        }
        .send{
            direction: rtl;
            text-align: right;
        }
        .recv{
            direction: ltr;
            text-align: left;
        }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function(){
        let sender = 'Me';
    function send()
    {
        let msg = $(".msg").val();
        console.log(msg);
        addMessageS(msg);
        $(".msg").val("");
        let data = {
            'sender' : '<?php echo e($sender); ?>',
            'msg': msg,
            'sid': '<?php echo e($subject->id); ?>',
            'recv': '<?php echo e($subject->teachers()->first()->id); ?>',
        };
        $.ajax({
            type: "POST",
            url: '/chats',
            data: data,
        });
        console.log('send');
    }

    $('#sendbtn').click(function(){
        send();
        console.log('clicked');
    });
    function addMessageS(cont)
    {
        console.log('#');
        let d = document.getElementById('chat_container');
        d.innerHTML += '<div class="recv">'+sender+'<span class="message badge badge-primary">'+cont+'</span></div>';
    }


    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('stdashboard.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/stdashboard/chat.blade.php ENDPATH**/ ?>