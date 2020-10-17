<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Session;

class ContactUsController_front extends Controller
{
    public function showContact(){
        return view('frontEnd.contacts.contactUs');
    }

    public function sendContactMail(Request $request){

        $this->validate($request, [
            'email' => 'email',
        ], [
            'email.email' =>' البريد الالكترونى غير صالح , من فضلك قم بادخال بريدك الالكترونى بشكل صحيح حتى تتمكن ادارة الموقع من التواصل معك مجددا وتقديم المساعدة لك .',
        ], [

        ]);

        Mail::send(new ContactMail());
        session()->flash('message','تم ارسال رسالتك لادارة الموقع وسيتم التواصل معك قريبا');
        return back();
    }
      public function SendToMail(Request $request){
        $this->validate($request, ['email' => 'required|email','phone' =>'required|numeric' ]);

        $data = array(
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'bodyMessage' => $request->message
        );

        Mail::send('mail', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('Girlssp017@gmail.com');
            $message->subject('Contact Details');
        });

     
   session()->flash('message','تم ارسال رسالتك لادارة الموقع وسيتم التواصل معك قريبا');
        return back();    

    }
}
