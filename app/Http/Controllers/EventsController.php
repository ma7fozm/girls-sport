<?php

namespace App\Http\Controllers;

use App\Event;
use App\Event_comments;
use App\Event_sponser;
use App\Group;
use App\Place;
use App\Sponser;
use App\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function index()
    {
        return view('admin.events.eventManagment')->with('events', Event::all());
    }


    public function create()
    {
        $teams = Team::where('status', '=', 1)->get();
        $groups = Group::where('status', '=', 1)->get();
        $places = Place::where('status', '=', 1)->get();
        $sponsors = Sponser::where('status', '=', 1)->get();
        return view('admin.events.createEvent', compact('teams', 'groups', 'places', 'sponsors'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'place_id' => 'required',
            'agenda' => 'required',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required|after:start_date',
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
            'num_of_attendees.required' => 'من فضلك حدد اقصى عدد مسموع به لحظور الفاعلية ',
            'num_of_attendees.numeric' => 'يجب ان يكون عدد الحظور عبارة عن رقم وليس نص',
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
        $event->event_type = 'لا للفراغ';
        $event->from_datetime = $from_datetime;
        $event->to_datetime = $to_datetime;
        $event->num_of_attendees = $request->num_of_attendees;
        $event->place_id = $request->place_id;
        $event->agenda = $request->agenda;
        $event->user_id = Auth::user()->id;
        $event->status = $request->status;
        $event->public = 1;
        $event->image = $event_img_path;

        if ($request->event_type == 'فريق'){
            $event->team_id = $request->team_id;
        }elseif ($request->event_type == 'جروب'){
            $event->group_id = $request->group_id;
        }

        $event->save();
        $event_id = DB::getPdo()->lastInsertId();

        if (isset($request->sponsors)) {
            foreach ($request->sponsors as $sponsor) {
                Event_sponser::create([
                    'event_id' => $event_id ,
                    'sponser_id' => $sponsor,
                    'status' => 1
                ]);
            }
        }

        Session::flash('message', 'تم اضافة الفاعلية بنجاح');
        return redirect('admin/events');
    }


    public function edit($id)
    {
        $event = Event::find($id);
        $teams = Team::where('status', '=', 1)->get();
        $groups = Group::where('status', '=', 1)->get();
        $places = Place::where('status', '=', 1)->get();
        $event_sponsors = $event->sponsors;
        $sponsors = Sponser::where('status', '=', 1)->get();

        foreach ($event_sponsors as $sponsor) {
            $event_sponsors_ids[] = $sponsor->id;
        }
        if (!isset($event_sponsors_ids)) {
            $event_sponsors_ids[] = NULL;
        }

        return view('admin.events.editEvent', compact('event_sponsors_ids','event','users', 'teams', 'groups', 'places', 'sponsors'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'place_id' => 'required',
            'agenda' => 'required',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required|after:start_date',
            'team_id' => 'required_if:event_type,==,فريق',
            'group_id' => 'required_if:event_type,==,جروب',
            'num_of_attendees' => 'required|numeric',

        ], [
            'name.required' => 'من فضلك ادخل  عنوان الفاعلية',
            'agenda.required' => 'من فضلك ادخل وصف للفاعلية',
            'place_id.required' => 'من فضلك حدد مكان الفاعلية',
            'start_date.required' => 'من فضلك حدد تاريخ و وقت بداية الفاعلية',
            'start_date.before' => 'يجب ان يكون وقت بداية الفاعلية قبل وقت انتهائها',
            'end_date.after' => 'يجب ان يكون وقت انتهاء الفاعلية بعد وقت بدايتها',
            'end_date.required' => 'من فضلك حدد تاريخ و وقت نهاية الفاعلية',
            'num_of_attendees.required' => 'من فضلك حدد اقصى عدد مسموع به لحظور الفاعلية ',
            'num_of_attendees.numeric' => 'يجب ان يكون عدد الحظور عبارة عن رقم وليس نص',
            'team_id.required_if' => ' من فظلك حدد الفريق المراد اضافة الفاعليه له',
            'group_id.required_if' => ' من فظلك حدد الجروب المراد اضافة الفاعليه له',
        ], []);

        $event = Event::find($id);
        $date = strtotime($request->start_date);
        $from_datetime = date('Y-m-d H:i:s', $date);

        $date = strtotime($request->end_date);
        $to_datetime = date('Y-m-d H:i:s', $date);

        if (request()->hasfile('eventImg')) {

            File::delete($event->image);
            $img = request()->file('eventImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/eventImages/'), 'img_' . time() . "." . $ext);
            $event_img_path = 'uploads/images/eventImages/img_' . time() . "." . $ext;
        } else {
            $event_img_path = $event->image;
        }


        $event->name = $request->name;
        $event->event_type = 'لا للفراغ';
        $event->from_datetime = $from_datetime;
        $event->to_datetime = $to_datetime;
        $event->num_of_attendees = $request->num_of_attendees;
        $event->place_id = $request->place_id;
        $event->agenda = $request->agenda;
        $event->image = $event_img_path;
        $event->status = $request->status;

        if ($request->event_type == 'فريق'){

            $event->team_id = $request->team_id;
            $event->group_id = NULL;

        }elseif ($request->event_type == 'جروب'){

            $event->group_id = $request->group_id;
            $event->team_id = NULL;

        }else{
            $event->team_id = NULL;
            $event->group_id = NULL;
        }

        $event->save();

        Event_sponser::where('event_id', '=', $event->id)->delete();

        if (isset($request->sponsors)) {
            foreach ($request->sponsors as $sponsor) {
                Event_sponser::create([
                    'event_id' => $event->id ,
                    'sponser_id' => $sponsor,
                    'status' => 1
                ]);
            }
        }

        Session::flash('message', 'تم تعديل بيانات الفاعلية بنجاح');
        return redirect('admin/events');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        session()->flash('message', 'تم حذف بيانات الفاعلية بنجاح');
        return back();
    }

    public function deleteEventComment($id)
    {
        Event_comments::find($id)->delete();
        Event_comments::where('parent', '=', $id)->delete();
        session()->flash('message', 'تم حذف التعليق بنجاح');
        return back();
    }

    public function deleteEventCommentReply($id)
    {
        Event_comments::find($id)->delete();
        session()->flash('message', 'تم حذف الرد بنجاح');
        return back();
    }

    public function active($id)
    {
        $event = Event::find($id);
        $event->status = 0;
        $event->save();

        session()->flash('message', 'تم الغاء تفعيل الفاعلية');
        return back();
    }

    public function unactive($id)
    {
        $event = Event::find($id);
        $event->status = 1;
        $event->save();

        session()->flash('message', 'تم تفعيل الفاعلية بنجاح');
        return back();
    }

    public function activeComment($id)
    {
        $event = Event_comments::find($id);
        $event->status = 0;
        $event->save();

        session()->flash('message', 'تم حظر التعليق');
        return back();
    }

    public function unactiveComment($id)
    {
        $event = Event_comments::find($id);
        $event->status = 1;
        $event->save();

        session()->flash('message', 'تم تفعيل التعليق بنجاح');
        return back();
    }

    public function showEventComments($id)
    {
        $event = Event::find($id);
        $comments = Event::find($id)->comments->where('parent', '=', 0);
        return view('admin/events/eventCommentsManagment', compact('event', 'comments'));

    }

    public function showCommentReplies($id)
    {
        $replies = Event_comments::find($id)->replies;
        $comment = Event_comments::find($id);
        return view('admin/events/eventCommentReplies', compact('replies', 'comment'));

    }

    public function storeMatchReply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ], ['reply.required' => 'قم بكتابة الرد اولا',], []);

        $match_id = Matches_comments::find($id)->match->id;

        Matches_comments::create([
            'match_id' => $match_id,
            'comment' => $request->reply,
            'parent' => $id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        return back();
    }

    public function storeEventReply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ], ['reply.required' => 'قم بكتابة الرد اولا',], []);

        $event_id = Event_comments::find($id)->event->id;

        Event_comments::create([
            'event_id' => $event_id,
            'comment' => $request->reply,
            'parent' => $id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        return back();
    }

    public function showEventAlbums($id)
    {
        $event = Event::find($id);
        $albums = Event::find($id)->albums;
        return view('admin/events/eventAlbumsManagment', compact('event', 'albums'));
    }

    public function getEventAlbums()
    {
        $albums = Event::find(request('eventID'))->albums;
        return response($albums);

    }
}
