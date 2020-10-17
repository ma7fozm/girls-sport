<?php

namespace App\Http\Controllers;

use App\Event;
use App\Event_comments;
use App\Event_user;
use App\Group;
use App\Message;
use App\Notification;
use App\Notifications\eventMessage;
use App\Notifications\joinRequest;
use App\Place;
use App\Team;
use App\User;
use App\Sponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EventController_front extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth', ['only' => ['index']]);
//    }

    public function index()
    {
        $events = Event::where('status', '=', 1)->orderBy('id', 'desc')->paginate(9);
        $places = Place::where('status', '=', 1)->get();

        if (Auth::guard('web')->check()) {
            $teams = Team::where('status', '=', 1)->where('admin_id', '=', Auth::user()->id)->get();
            $groups = Group::where('status', '=', 1)->where('admin_id', '=', Auth::user()->id)->get();
        } else {
            $teams = collect();
            $groups = collect();
        }

        return view('frontEnd.events.events', compact('events', 'teams', 'groups', 'places'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'msgTitle' => 'required',
            'msgContent' => 'required',
            'msgImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
        ], [
            'msgTitle.required' => 'من فضلك ادخل عنوان الرسالة',
            'msgContent.required' => 'من فضلك ادخل محتوى الرسالة',
            'msgImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لهذا لن تتم اضافته ',
        ], [

        ]);

        if (request()->hasfile('msgImg')) {
            $img = request()->file('msgImg');
            $ext = strtolower($img->getClientOriginalExtension());
            $img->move(public_path('uploads/images/msgsImages/'), 'img_' . time() . "." . $ext);
            $msg_img_path = 'uploads/images/msgsImages/img_' . time() . "." . $ext;
        } else {
            $msg_img_path = NULL;
        }

        Message::create([
            'title' => $request->msgTitle,
            'content' => $request->msgContent,
            'parent' => 0,
            'event_id' => $request->eventID,
            'image' => $msg_img_path,
            'status' => 1,
            'user_id' => Auth::user()->id,
        ]);

        $event = Event::find($request->eventID);
        $admin_users = User::where('roles_id','=',1)->get();

        foreach ($admin_users as $user){
            $user->notify(new eventMessage(Auth::user(), $event, 'message'));
        }
    }


    public function storeEvent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'place_id' => 'required',
            'agenda' => 'required',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required|after:start_date',
            'event_type' => 'required',
            'team_id' => 'required_if:event_type,==,فريق',
            'group_id' => 'required_if:event_type,==,جروب',
            'num_of_attendees' => 'required|numeric',
            'eventImg' => 'required',

        ], [
            'name.required' => 'من فضلك ادخل  عنوان الفاعلية',
            'agenda.required' => 'من فضلك ادخل وصف للفاعلية',
            'place_id.required' => 'من فضلك حدد مكان الفاعلية',
            'start_date.required' => 'من فضلك حدد تاريخ و وقت بداية الفاعلية',
            'start_date.before' => 'يجب ان يكون وقت بداية الفاعلية قبل وقت انتهائها',
            'end_date.after' => 'يجب ان يكون وقت انتهاء الفاعلية بعد وقت بدايتها',
            'end_date.required' => 'من فضلك حدد تاريخ و وقت نهاية الفاعلية',
            'event_type.required' => 'من فضلك حدد الفئة المراد اضافة الفاعلية لها',
            'num_of_attendees.required' => 'من فضلك حدد اقصى عدد مسموع به لجضور الفاعلية ',
            'num_of_attendees.numeric' => 'يجب ان يكون عدد المشاركين عبارة عن رقم وليس نص',
            'team_id.required_if' => ' من فظلك حدد الفريق المراد اضافة الفاعليه له',
            'group_id.required_if' => ' من فظلك حدد الجروب المراد اضافة الفاعليه له',
            'eventImg.required' => 'من فضلك قم باختيار صورة معبرة عن مضمون الفاعلية التى تود انشائها ',
        ], []);

        $date = strtotime($request->start_date);
        $from_datetime = date('Y-m-d H:i:s', $date);

        $date = strtotime($request->end_date);
        $to_datetime = date('Y-m-d H:i:s', $date);

        if (request()->hasfile('eventImg')) {

            $img = request()->file('eventImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/eventImages/'), 'img_' . time() . "." . $ext);
            $event_img_path = 'uploads/images/eventImages/img_' . time() . "." . $ext;
        } else {
            $event_img_path = NULL;
        }

        $event = new Event;
        $event->name = $request->name;
        $event->from_datetime = $from_datetime;
        $event->to_datetime = $to_datetime;
        $event->num_of_attendees = $request->num_of_attendees;
        $event->place_id = $request->place_id;
        $event->agenda = $request->agenda;
        $event->user_id = Auth::user()->id;
        $event->status = 1;
        $event->public = 2;
        $event->image = $event_img_path;

        if ($request->event_type == 'team') {
            $event->team_id = $request->team_id;
            $event->event_type = 'فريق';
        } elseif ($request->event_type == 'group') {
            $event->group_id = $request->group_id;
            $event->event_type = 'جروب';
        }

        $event->save();
        $event_id = DB::getPdo()->lastInsertId();

        if (isset($request->sponsors)) {
            foreach ($request->sponsors as $sponsor) {
                Event_sponser::create([
                    'event_id' => $event_id,
                    'sponser_id' => $sponsor,
                    'status' => 1
                ]);
            }
        }
         Event_user::create([
            'event_id' => DB::getPdo()->lastInsertId(),
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);
    }

    public function show($id)
    {
        $event = Event::find($id);
        return view('frontEnd.events.event_details', compact('event'));
    }

    public function joinEvent($id)
    {
        Event_user::create([
            'event_id' => $id,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);

        $event = Event::find($id);
        $event_admin = $event->eventAdmin;

        $event_admin->notify(new joinRequest(Auth::user(), $event, 'event'));

        session()->flash('message', 'تم ارسال طلب الانضمام للفعالية !');
        $url = URL::to(url()->previous()) . '#scroll';
        return Redirect::to($url);
    }

    public function disJoinEvent($id)
    {
        Event_user::where('event_id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();

        $notifications = Notification::all();

        foreach ($notifications as $notification) {
           if (json_decode($notification->data, true)['user']['id'] == Auth::user()->id &&
               json_decode($notification->data, true)['joined']['id'] == $id)
               $notification->delete();
        }

        session()->flash('message', 'تم الغاء انضمامك للفعالية !');

        $url = URL::to(url()->previous()) . '#scroll';
        return Redirect::to($url);
    }

    public function addReply(Request $request, $event_id, $comment_id)
    {
        if ($request->reply == '') {
            $url = URL::to('events/' . $event_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة الرد اولا');
        }

        Event_comments::create([
            'event_id' => $event_id,
            'comment' => $request->reply,
            'parent' => $comment_id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة الرد بنجاح');
        $url = URL::to('events/' . $event_id) . '#scroll';
        return Redirect::to($url);
    }

    public function editComment(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required',
        ], [
            'comment.required' => 'من فضلك اضف تعليقك',
        ], []);

        $comment = Event_comments::find($request->commentID);

        $comment->comment = $request->comment;
        $comment->save();

    }

    public function deleteComment(Request $request, $event_id, $comment_id)
    {
        $comment = Event_comments::find($comment_id);

        if ($comment->parent == 0) {
            Event_comments::where('parent', '=', $comment->id)->delete();
        }
        $comment->delete();

        session()->flash('message', 'تم الحذف بنجاح !');
        $url = URL::to('events/' . $event_id) . '#scroll';
        return Redirect::to($url);
    }

    public function addComment(Request $request, $event_id)
    {
        if ($request->comment == '') {
            $url = URL::to('events/' . $event_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة التعليق اولا');
        }

        Event_comments::create([
            'event_id' => $event_id,
            'comment' => $request->comment,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة تعليقك بنجاح');
        $url = URL::to('events/' . $event_id) . '#scroll';
        return Redirect::to($url);
    }

    public function showEventProfile()
    {

        $user = Auth::user();
         $teams = Team::where('status', '=', 1)->get();
        $groups = Group::where('status', '=', 1)->get();
        $places = Place::where('status', '=', 1)->get();
        $sponsors = Sponser::where('status', '=', 1)->get();
        $events = $user->events()->wherePivot('status', '=', '1')->paginate(8);
        return view('frontEnd.events.events_profile', compact('user', 'events','places','groups','teams','sponsors'));
    }

}
