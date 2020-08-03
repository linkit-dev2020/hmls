<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCommentNotif extends Notification
{
    use Queueable;
    private $username='';
    private $msg='';
    private $url='';
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($username,$lesson,$url,$ch=false)
    {
        //
        $this->username=$username;
        $this->msg='علق ';
        $this->msg.=$this->username;
        if(!$ch)
            $this->msg.=' أيضا على الدرس  ';
        else
            $this->msg.='  على الدرس  ';
        $this->msg.=$lesson;
        $this->url=$url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'data'=>$this->msg,
            'url'=>$this->url
        ];
    }
}
