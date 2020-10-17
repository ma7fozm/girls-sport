<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController_front extends Controller
{
    public function index(){
        $user = Auth::user();
        $messages = $user->messages()->where(['status'=>1 , 'parent'=>0])->paginate(6);

        return view('frontEnd.messages.message_profile',compact('messages','user'));
    }
}
