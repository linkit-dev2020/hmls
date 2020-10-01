<?php $__env->startSection('content'); ?>
    <div id="chat_container">
        <?php $__currentLoopData = $msg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($m->sender === Auth::user()->id): ?>

            <div class="send">
                Me
                <span class="message badge badge-primary">
                    <?php echo e($m->content); ?>

                </span>
            </div>
            <?php else: ?>
            <div class="recv">
                Teacher
                <span class="message badge badge-primary">
                    <?php echo e($m->content); ?>

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
    let sender = 'me';
    function send()
    {
        let msg = $(".msg").val();
        console.log(msg);
        addMessageS(msg,'send');
        $(".msg").val("");
        let data = {
            'conversation_id':'<?php echo e($convid); ?>',
            'content':msg,
            'sender': <?php echo e($sender); ?>,
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

    function addMessageS(cont,type)
    {
        console.log('#');
        let ss;
        if(type=="recv")
            ss =  'To me';
        else
            ss= 'Me';
        let d = document.getElementById('chat_container');
        d.innerHTML += '<div class="'+type+'">'+ss+'<span class="message badge badge-primary">'+cont+'</span></div>';
    }
    function getNew() {
        $.ajax({
            url:'<?php echo e($url); ?>',
            type:'get',
            success:  function(data)
            {
                console.log(data);
                for(let i=0;i<data.data.length;i++)
                {

                    {
                        addMessageS(data.data[i]['content'],'recv');
                        console.log(data.data[i]['content']);
                    }
                }
            }
        }
        );
        setTimeout(getNew,3000);
    }
    getNew();

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('stdashboard.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\hmls\resources\views/stdashboard/chat.blade.php ENDPATH**/ ?>