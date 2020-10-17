<?php

namespace App\Http\Controllers;

use App\Group;
use App\Notification;
use App\Notifications\joinRequest;
use App\Team;
use App\TeamUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class TeamController_front extends Controller
{

    public function index()
    {
        $teams = Team::orderBy('id', 'desc')->where('status', '=', 1)->paginate(6);
        return view('frontEnd.teams.teams', compact('teams'));
    }

    public function show($id)
    {
        $team = Team::find($id);

        $users_per_page = 8;
        $articles_per_page = 4;
        $matchs_per_page = 4;
        $groups_per_page = 6;
        $images_per_page = 8;
        $videos_per_page = 6;

        $users = $team->users()->wherePivot('status', '=', 1)->orderBy('id', 'desc')->paginate($users_per_page);
        $articles = $team->articles()->where('status', '=', 1)->orderBy('id', 'desc')->paginate($articles_per_page);
        $matchs = $team->matchs()->where('result', '!=', NULL)->wherePivot('status', '=', 1)->orderBy('id', 'desc')->paginate($matchs_per_page);
        $groups = $team->groups()->where('status', '=', 1)->paginate($groups_per_page);
        $images = $team->medias()->where(['status' => 1, 'type' => 'صورة'])->paginate($images_per_page);
        $videos = $team->medias()->where(['status' => 1, 'type' => 'فيديو'])->paginate($videos_per_page);

        $users_count = $team->users()->wherePivot('status', '=', 1)->orderBy('id', 'desc')->count();
        $articles_count = $team->articles()->where('status', '=', 1)->orderBy('id', 'desc')->count();
        $matchs_count = $team->matchs()->where('result', '!=', NULL)->wherePivot('status', '=', 1)->orderBy('id', 'desc')->count();
        $groups_count = $team->groups()->where('status', '=', 1)->count();
        $images_count = $team->medias()->where(['status' => 1, 'type' => 'صورة'])->count();
        $videos_count = $team->medias()->where(['status' => 1, 'type' => 'فيديو'])->count();

        $count_res = [
            'us' => ceil($users_count / $users_per_page),
            'art' => ceil($articles_count / $articles_per_page),
            'mat' => ceil($matchs_count / $matchs_per_page),
            'gro' => ceil($groups_count / $groups_per_page),
            'img' => ceil($images_count / $images_per_page),
            'vid' => ceil($videos_count / $videos_per_page),
        ];

        $max_length = array_search(max($count_res), $count_res);

        return view('frontEnd.teams.team_details', compact('team', 'users', 'articles', 'matchs', 'groups', 'images', 'videos', 'max_length'));

    }

    public function joinTeam($id)
    {
        TeamUser::create([
            'team_id' => $id,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);

        $team = Team::find($id);
        $team_admin = $team->teamAdmin;

        $team_admin->notify(new joinRequest(Auth::user(), $team, 'team'));

        session()->flash('message', 'تم ارسال طلب الانضمام للفريق !');
        $url = URL::to(url()->previous()) . '#scroll';
        return Redirect::to($url);
    }

    public function disJoinTeam($id)
    {
        TeamUser::where('team_id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();

        $notifications = Notification::all();

        foreach ($notifications as $notification) {
            if (json_decode($notification->data, true)['user']['id'] == Auth::user()->id &&
                json_decode($notification->data, true)['joined']['id'] == $id) {
                $notification->delete();
            }
        }

        session()->flash('message', 'تم الغاء انضمامك للفريق !');
        $url = URL::to(url()->previous()) . '#scroll';
        return Redirect::to($url);
    }

    public function deleUser($team_id, $user_id)
    {
        TeamUser::where('team_id', '=', $team_id)->where('user_id', '=', $user_id)->delete();

        session()->flash('message', 'تم حذف العضو من الفريق !');
        $url = URL::to(url()->previous()) . '#scroll_mem';
        return Redirect::to($url);
    }

    public function addTeamGroup(Request $request)
    {
        $this->validate($request, [
            'group_name' => 'required',
            'description' => 'required',
            'groupImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
        ], [
            'group_name.required' => 'من فضلك ادخل اسم المجموعة',
            'description.required' => 'من فضلك ادخل وصف المجموعة',
            'groupImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لتلك المجموعة لهذا لن تتم اضافته , من فضلك قم باختيار صورة اخرى للمجموعة',
        ], [

        ]);

        if (request()->hasfile('groupImg')) {

            $img = request()->file('groupImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/groupImages/'), 'img_' . time() . "." . $ext);
            $group_img_path = 'uploads/images/groupImages/img_' . time() . "." . $ext;
        } else {
            $group_img_path = NULL;
        }

        $team = Team::find($request->teamID);

        Group::create([
            'name' => $request->group_name,
            'description' => $request->description,
            'status' => 0,
            'team_id' => $team->id,
            'sport_id' => $team->sport_id,
            'admin_id' => Auth::user()->id,
            'user_id' => Auth::user()->id,
            'image_url' => $group_img_path,
        ]);
    }

    public function showTeamProfile()
    {
        $user = Auth::user();
        $teams = $user->teams()->wherePivot('status', '=', 1)->paginate(8);
        $admin_teams = Team::orderBy('id', 'desc')->where('status', '=', 1)->where('admin_id', '=', $user->id)->paginate(8);

        return view('frontEnd.teams.team_profile', compact('teams', 'admin_teams', 'user'));
    }
}
