<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $role_id = $this->user->roles_id;
        if ($role_id !=4){
            return $this->view('frontEnd.emails.sendView')->subject("تفعيل عضويتك في جيرلز سبورتس");
        }else{
            return $this->view('frontEnd.emails.sendPlayerView')->subject("تفعيل عضويتك في جيرلز سبورتس");
        }
    }
}
