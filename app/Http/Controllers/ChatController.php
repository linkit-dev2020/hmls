<?php

namespace App\Http\Controllers;

use App\Message;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getConversation($id)
    {
        $sender  =Auth::user()->id;
        $subject = Subject::find($id);
        $msg = Message::where('chat_id',$id)->where('sender_id',$sender)->orWhere('receiver_id',$sender)->get();
        return view('stdashboard.chat',compact('msg','subject','sender'));
    }
    public function getConversations() {
        $msg = Message::where('receiver_id',Auth::user()->id)->get();
        $vis=[];
        $conv = [];
        foreach($msg as $m)
        {
            if($vis[$m->sender_id]) continue;

            array_push($conv,$m->sender_id);
            $vis[$m->sender_id] = true;
        }
        return view('admin.chats',compact('conv'));
    }
    public function sendMsg(Request $req)
    {
        $sender = $req->sender;
        $recv = $req->recv;
        $msg = $req->msg;

        $m = new Message();
        $m->sender_id = $sender;
        $m->receiver_id = $recv;
        $m->msg = $msg;
        $m->chat_id = $req->sid;
        $m->save();
        return 'success';
    }
    public function getNew($id)
    {
        $msg = Message::where('sender_id',$id)->where('received',0)->get();
        foreach($msg as $m)
        {
            $m->received = 1;
            $m->save();
        }
        return response()->json(['data'=>$msg]);
    }
}
