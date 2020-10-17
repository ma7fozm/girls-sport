<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class joinAccept extends Notification
{
    use Queueable;

    public $user, $joined , $type;
    public function __construct($user, $joined,$type)
    {
        $this->user = $user;
        $this->joined = $joined;
        $this->type = $type;
        return $this->type;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    public function toArray($notifiable)
    {
        return [
            'user'=> $this->user,
            'joined'=> $this->joined,
            'type'=> $this->type,
        ];
    }
}
