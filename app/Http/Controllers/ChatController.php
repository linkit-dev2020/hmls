<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getConversation($id)
    {
        $uid = Auth::user()->id;
        $conv = Conversation::where('sender',$uid)->where('subject',$id)->get()->first();
        $isAdmin = false;
        $sender = $uid;
        $msg = null;
        if($conv!=null)
        $msg = $conv->messages()->get();
        if(!is_null($msg))
        foreach($msg as $m)
        {
            if($m->sender == $uid)
            {
                $m->seen = 1;
                $m->save();
            }
        }


        $subject = Subject::find($id);
        $url = '/chat/get/'.$subject->id;
        $convid='';
        if($conv!=null)
        {
            $convid= $conv->id;
            return view('stdashboard.chat',compact('msg','subject','sender','convid','isAdmin','subject','url'));
        }
        $conv = new Conversation();
        $conv->subject = $id;
        $conv->sender = $uid;
        $conv->save();
        $convid= $conv->id;
        return view('stdashboard.chat',compact('msg','subject','sender','convid','isAdmin','url'));
    }
    public function getConversationAdmin($id)
    {
        $uid = Auth::user()->id;
        $conv = Conversation::find($id);
        $isAdmin = true;
        $sender = $uid;
        $msg = null;
        $url = '/chat/get/'.$conv->id.'/admin';
        if($conv!=null)
            $msg = $conv->messages()->get();
        foreach($msg as $m)
        {
            if($m->sender != $uid)
            {
                $m->seen = 1;
                $m->save();
            }
        }

        $subject = Subject::find($conv->subject);
        $convid= $conv->id;

        return view('stdashboard.chat',compact('msg','subject','sender','convid','isAdmin','url'));

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
        $conv = $req->conversation_id;
        $m = new Message();
        $m->conversation_id = $conv;
        $m->content = $req->content;
        $m->sender = $req->sender;
        $m->save();
        return 'success';
    }
    public function getNew($id)
    {
        $msg = Conversation::where('subject',$id)
                ->get()
                ->first()
                ->messages()
                ->where('seen',0)
                ->where('sender','!=',Auth::user()->id)
                ->get();
        foreach($msg as $m)
        {
            $m->seen = 1;
            $m->save();
        }
        return response()->json(['data'=>$msg]);
    }

    public function getNewAdmin($id)
    {
        $msg = Conversation::find($id)
                ->messages()
                ->where('seen',0)
                ->where('sender','!=',Auth::user()->id)
                ->get();
        foreach($msg as $m)
        {


                $m->seen = 1;
                $m->save();

        }
        return response()->json(['data'=>$msg]);
    }
}
