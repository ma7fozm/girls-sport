<?php

namespace App\Http\Controllers;

use App\Match;
use App\Match_Sponsor;
use App\Matches_comments;
use App\MatchTeam;
use App\MatchUser;
use App\Place;
use App\Sponser;
use App\Team;
use App\User;
use App\Leagues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MatchController extends Controller
{

    public function index($id = null)
    {
        $matchs = Match::all();
        return view('admin.matchs.matchManagment', compact('matchs'));
    }

    public function showLegaMatches($id)
    {
        $matchs = Leagues::find($id)->matches;
        return view('admin.matchs.matchManagment', compact('matchs'));
    }

    public function create()
    {
        $users = User::whereIn('roles_id', [4, 5])->get();
        $teams = Team::where('status', '=', 1)->get();
        $places = Place::where('status', '=', 1)->get();
        $sponsors = Sponser::where('status', '=', 1)->get();
        $leagues = Leagues::where('status', '=', 1)->get();
        return view('admin.matchs.createMatch', compact('users', 'teams', 'places', 'sponsors', 'leagues'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'place_id' => 'required',
            'matchImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
            'match_type' => 'required',
        ], [
            'title.required' => 'من فضلك ادخل  عنوان للخبر',
            'description.required' => 'من فضلك ادخل وصف للمباراة',
            'place.required' => 'من فضلك حدد مكان المباراة',
            'matchImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لهذا لن تتم اضافته , من فضلك قم باختيار صورة اخرى للمباراة',
            'match_type.required' => 'من فضلك قم بتحديد اذا ما كانت المباراة فردية ام جماعية',

        ], []);

        $date1 = strtr($request->date, '/', '-');
        if (strtotime($date1)) {
            $date_in_sec = strtotime($date1);
            $match_date = date("Y-m-d", $date_in_sec);
        } else {
            $validationErrors[] = 'من فضلك قم باختيار تاريخ المباراة';
        }

        if (strtotime($request->start_time)) {
            $start_time = gmdate("H:i:s", strtotime($request->start_time));
        } else {
            $validationErrors[] = 'من فضلك قم باختيار وقت بداية المباراة';
        }

        if (strtotime($request->end_time)) {
            $end_time = gmdate("H:i:s", strtotime($request->end_time));
        } else {
            $validationErrors[] = 'من فضلك قم باختيار وقت نهاية المباراة';
        }

        if (strtotime($request->start_time) > strtotime($request->end_time)) {
            $validationErrors[] = 'لا يمكن ان يكون وقت انتهاء المباراة قبل وقت بدايتها';
        } elseif (strtotime($request->start_time) == strtotime($request->end_time)) {
            $validationErrors[] = 'لا يمكن ان يكون وقت بداية المباراة هو نفسه وقت انتهائها , من فضلك ادخل البيانات بشكل صحيح';
        }

        if ($request->match_type == 'single') {
            if (!isset($request->user1_id) || !isset($request->user2_id)) {
                $validationErrors[] = 'من فضلك قم باختيار الاعضاء المشتركيين فى المباراة';
            }
        } elseif ($request->match_type == 'team') {
            if (!isset($request->team1_id) || !isset($request->team2_id)) {
                $validationErrors[] = 'من فضلك قم باختيار الفرق المشاركة فى المباراة';
            }
        }

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

        if (request()->hasfile('matchImg')) {

            $img = request()->file('matchImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/matchImages/'), 'img_' . time() . "." . $ext);
            $match_img_path = 'uploads/images/matchImages/img_' . time() . "." . $ext;
        } else {
            $match_img_path = NULL;
        }

        if ($request->league_id != null) {
            $league_id = $request->league_id;
        } else {
            $league_id = null;
        }
        $id = Match::create([
            'title' => $request->title,
            'description' => $request->description,
            'place' => $request->place,
            'status' => $request->status,
            'date' => $match_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'match_type' => $request->match_type,
            'image' => $match_img_path,
            'place_id' => $request->place_id,
            'user_id' => Auth::user()->id,
            'league_id' => $league_id,
        ])->id;

        if ($request->match_type == 'team') {
            MatchTeam::create([
                'match_id' => $id,
                'team_id' => $request->team1_id,
            ]);
            MatchTeam::create([
                'match_id' => $id,
                'team_id' => $request->team2_id,
            ]);
        } elseif ($request->match_type == 'single') {
            MatchUser::create([
                'match_id' => $id,
                'user_id' => $request->user1_id,
            ]);
            MatchUser::create([
                'match_id' => $id,
                'user_id' => $request->user2_id,
            ]);
        }

        if (isset($request->sponsors)) {
            foreach ($request->sponsors as $sponsor) {
                Match_Sponsor::create([
                    'match_id' => $id,
                    'sponser_id' => $sponsor,
                    'status' => 1
                ]);
            }
        }

        session()->flash('message', 'تم اضافة بيانات المباراة بنجاح');
        return redirect('admin/matchs');

    }

    public function edit($id)
    {
        $match = Match::find($id);
        $users = User::whereIn('roles_id', [4, 5])->get();
        $teams = Team::where('status', '=', 1)->get();
        $places = Place::where('status', '=', 1)->get();
        $leagues = Leagues::where('status', '=', 1)->get();
        $match_sponsors = $match->sponsors;
        $sponsors = Sponser::all();
        foreach ($match_sponsors as $match_sponsor) {
            $match_sponsors_ids[] = $match_sponsor->id;
        }
        if (!isset($match_sponsors_ids)) {
            $match_sponsors_ids[] = NULL;
        }
        return view('admin.matchs.editMatch', compact('match', 'users', 'teams', 'places', 'sponsors', 'match_sponsors_ids', 'leagues'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'matchImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
            'match_type' => 'required',

        ], [
            'title.required' => 'من فضلك ادخل  عنوان للخبر',
            'description.required' => 'من فضلك ادخل وصف للمباراة',
            'place.required' => 'من فضلك حدد مكان المباراة',
            'matchImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لهذا لن تتم اضافته , من فضلك قم باختيار صورة اخرى للمباراة',
            'match_type.required' => 'من فضلك قم بتحديد اذا ما كانت المباراة فردية ام جماعية',
        ], []);

        $match = Match::find($id);

        $date1 = strtr($request->show_date, '/', '-');
        if (strtotime($date1)) {
            $date_in_sec = strtotime($date1);
            $match_date = date("Y-m-d", $date_in_sec);
        } else {
            $validationErrors[] = 'من فضلك قم باختيار تاريخ المباراة';
        }

        if (strtotime($request->start_time)) {
            $start_time = gmdate("H:i:s", strtotime($request->start_time));
        } else {
            $validationErrors[] = 'من فضلك قم باختيار وقت بداية المباراة';
        }

        if (strtotime($request->end_time)) {
            $end_time = gmdate("H:i:s", strtotime($request->end_time));
        } else {
            $validationErrors[] = 'من فضلك قم باختيار وقت نهاية المباراة';
        }

        if (strtotime($request->start_time) > strtotime($request->end_time)) {
            $validationErrors[] = 'لا يمكن ان يكون وقت انتهاء المباراة قبل وقت بدايتها';
        } elseif (strtotime($request->start_time) == strtotime($request->end_time)) {
            $validationErrors[] = 'لا يمكن ان يكون وقت بداية المباراة هو نفسه وقت انتهائها , من فضلك ادخل البيانات بشكل صحيح';
        }

        if ($request->match_type == 'single') {
            if (!isset($request->user1_id) || !isset($request->user2_id)) {
                $validationErrors[] = 'من فضلك قم باختيار الاعضاء المشتركيين فى المباراة';
            }
        } elseif ($request->match_type == 'team') {
            if (!isset($request->team1_id) || !isset($request->team2_id)) {
                $validationErrors[] = 'من فضلك قم باختيار الفرق المشاركة فى المباراة';
            }
        }

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

        if (request()->hasfile('matchImg')) {

            File::delete($match->image);
            $img = request()->file('matchImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/matchImages/'), 'img_' . time() . "." . $ext);
            $match_img_path = 'uploads/images/matchImages/img_' . time() . "." . $ext;
        } else {
            $match_img_path = $match->image;
        }

        $match->title = $request->title;
        $match->description = $request->description;
        $match->place_id = $request->place_id;
        $match->status = $match->status;
        $match->date = $match_date;
        $match->start_time = $start_time;
        $match->end_time = $end_time;
        $match->match_type = $request->match_type;
        $match->image = $match_img_path;
        $match->result = $request->result;
        $match->league_id = $request->league_id;
        $match->save();

        if ($request->match_type == 'team') {
            MatchTeam::where('match_id', '=', $match->id)->delete();
            MatchUser::where('match_id', '=', $match->id)->delete();

            MatchTeam::create([
                'match_id' => $match->id,
                'team_id' => $request->team1_id,
            ]);
            MatchTeam::create([
                'match_id' => $match->id,
                'team_id' => $request->team2_id,
            ]);
        } elseif ($request->match_type == 'single') {

            MatchUser::where('match_id', '=', $match->id)->delete();
            MatchTeam::where('match_id', '=', $match->id)->delete();

            MatchUser::create([
                'match_id' => $match->id,
                'user_id' => $request->user1_id,
            ]);
            MatchUser::create([
                'match_id' => $match->id,
                'user_id' => $request->user2_id,
            ]);
        }

        Match_Sponsor::where('match_id', '=', $match->id)->delete();

        if (isset($request->sponsors)) {
            foreach ($request->sponsors as $sponsor) {
                Match_Sponsor::create([
                    'match_id' => $match->id,
                    'sponser_id' => $sponsor,
                    'status' => 1
                ]);
            }
        }
        session()->flash('message', 'تم تعديل بيانات المباراة بنجاح');
        return redirect('admin/matchs');


    }

    public function destroy($id)
    {
        $match = Match::find($id);
        File::delete($match->image);
        $match->delete();
        session()->flash('message', 'تم حذف بيانات المباراة بنجاح');
        return back();
    }

    public function deleteMatchComment($id)
    {
        Matches_comments::find($id)->delete();
        Matches_comments::where('parent', '=', $id)->delete();
        session()->flash('message', 'تم حذف التعليق بنجاح');
        return back();
    }

    public function deleteMatchCommentReply($id)
    {
        Matches_comments::find($id)->delete();
        session()->flash('message', 'تم حذف الرد بنجاح');
        return back();
    }

    public function active($id)
    {
        $match = Match::find($id);
        $match->status = 0;
        $match->save();

        session()->flash('message', 'تم الغاء تفعيل المباراة');
        return back();
    }

    public function unactive($id)
    {
        $match = Match::find($id);
        $match->status = 1;
        $match->save();

        session()->flash('message', 'تم تفعيل المباراة بنجاح');
        return back();
    }

    public function activeComment($id)
    {
        $match = Matches_comments::find($id);
        $match->status = 0;
        $match->save();

        session()->flash('message', 'تم حظر التعليق');
        return back();
    }

    public function unactiveComment($id)
    {
        $match = Matches_comments::find($id);
        $match->status = 1;
        $match->save();

        session()->flash('message', 'تم تفعيل التعليق بنجاح');
        return back();
    }

    public function showMatchComments($id)
    {
        $match = Match::find($id);
        $comments = Match::find($id)->comments->where('parent', '=', 0);
        return view('admin/matchs/matchCommentsManagment', compact('match', 'comments'));

    }

    public function showCommentReplies($id)
    {
        $replies = Matches_comments::find($id)->replies;
        $comment = Matches_comments::find($id);
        return view('admin/matchs/matchCommentReplies', compact('replies', 'comment'));

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
}


