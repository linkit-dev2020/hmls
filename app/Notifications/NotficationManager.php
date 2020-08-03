<?php
/**
 * Created by PhpStorm.
 * User: samo
 * Date: 9/7/2019
 * Time: 1:24 AM
 */

namespace App\Notifications;


use App\ClassRoom;
use App\Lesson;
use App\Subject;
use App\User;
use Hamcrest\Core\Set;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class NotficationManager
{
    public static function notifyNewLessonClass(Subject $subject)
    {
        $class=$subject->class;
        foreach ($class->students as $student)
        {
            Notification::send($student,new NewLesson($subject->name,'/stdsh/show/'.$subject->id,$subject->class->name));
        }
        // notify all managers
        self::notifyAllManagers(new NewLesson($subject->name,'/stdsh/show/'.$subject->id,$subject->class->name));
    }

    public static function notifyNewComment(Lesson $lesson,$commenter,$id)
    {
        $cmts=$lesson->comments;
        $arr=[];
        foreach ($cmts as $cmt)
        {
            if($cmt->commenter==null) continue;
            if(array_search($cmt->commenter->id,$arr)) continue;
            if($cmt->commenter!=null && $cmt->commenter->id!=$id )
                Notification::send($cmt->commenter, new NewCommentNotif($commenter, $lesson->title,URL::previous()));
            array_push($arr,$cmt->commenter->id);
        }

        $arr=[];
        foreach ($lesson->teachers as $cmt)
        {
            if(array_search($cmt->id,$arr)) continue;
            if($cmt!=null && $cmt->id!=$id )
                Notification::send($cmt, new NewCommentNotif($commenter, $lesson->title,URL::previous(),true));
            array_push($arr,$cmt->id);
        }

        self::notifyAllManagers(new NewCommentNotif($commenter, $lesson->title,URL::previous(),true));
    }

    public static  function notifyReply(Lesson $lesson,$replier,User $commenter)
    {
        Notification::send($commenter,new ReplyNotification($replier,$lesson->title,URL::previous()));
    }


    public static function notifyNewUnit(Subject $class,User $user)
    {
        $msg='قام ';
        $msg.=$user->username;
        $msg.=' باضافة وحدة جديدة الى المادة ';
        $msg.=$class->name;
        $url='/stdsh/show/'.$class->id;
        self::notifyAllManagers(new ToAdminModeratorNotf($msg,$url));
        self::notifyAllStudent(new ToAdminModeratorNotf($msg,$url),$class->class->students);
    }


    public static function notifyNewTest(Subject $class,User $user)
    {
        $msg='قام ';
        $msg.=$user->username;
        $msg.=' باضافة اختبار جديد الى المادة ';
        $msg.=$class->name;
        $url='/stdsh/show/'.$class->id;
        self::notifyAllManagers(new ToAdminModeratorNotf($msg,$url));
        self::notifyAllStudent(new ToAdminModeratorNotf($msg,$url),$class->class->students);
    }


    public static function notifyAllManagers(\Illuminate\Notifications\Notification $notification)
    {
        // notify all managers
        $users=User::all();
        foreach ($users as $user)
        {
            if($user->hasRole(2)) continue;
            if($user->hasRole(3)) continue;
            Notification::send($user, $notification);
        }
    }

    public static function notifyAllStudent(\Illuminate\Notifications\Notification $notification,Collection $users)
    {
        // notify all managers
        foreach ($users as $user)
        {
            Notification::send($user, $notification);
        }
    }
}
