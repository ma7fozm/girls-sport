<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class eventMessage extends Notification
{
    use Queueable;

    public $user, $event , $type;

    public function __construct($user, $event,$type)
    {
        $this->user = $user;
        $this->event = $event;
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
            'event'=> $this->event,
            'type'=> $this->type,
        ];
    }
}
