<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function showRequests()
    {
        $user = Auth::user();
        $events = Event::where(['user_id' => $user->id, 'status' => 1])->get();

        return view('admin.requests.request', compact( 'events'));
    }
}
