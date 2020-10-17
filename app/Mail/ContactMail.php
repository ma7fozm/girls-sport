<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->view('frontEnd.emails.contactMailView',['msg'=>$request->message,'fname'=>$request->fname,'lname'=>$request->lname,'email'=>$request->email,'phone'=>$request->phone])
            ->to('girlssport131@gmail.com')->subject("تواصل معانا")->from('websiteGilsSports@gmail.com', 'Girls Sport');
    }
}
