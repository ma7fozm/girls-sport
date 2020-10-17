<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsReaded(){
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        return back();
    }

    public function visitedLink($id){
        $notify = Notification::find($id);
        $notify->clicked = 1;
        $notify->save();
        return back();
    }
}
