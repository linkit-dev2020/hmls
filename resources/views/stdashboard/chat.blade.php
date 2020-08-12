@extends('stdashboard.master2')
@section('content')
    <div id="chat_container">
        @foreach($msg as $m)
            @if($m->sender_id == Auth::user()->id)
            <div class="send">
                {{\App\User::find($m->sender_id)->fullname}}
                <span class="message badge badge-primary">
                    {{$m->msg}}
                </span>
            </div>
            @else
            <div class="recv">
                {{\App\User::find($m->sender_id)->fullname}}
                <span class="message badge badge-primary">
                    {{$m->msg}}
                </span>
            </div>
            @endif
        @endforeach
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

@endsection

@section('js')
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
            'sender' : '{{$sender}}',
            'msg': msg,
            'sid': '{{$subject->id}}',
            'recv': '{{$subject->teachers()->first()->id}}',
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
@endsection
