<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Country_City;
use App\Event;
use App\Event_user;
use App\Group;
use App\GroupUser;
use App\Notifications\joinAccept;
use App\role;
use App\Sport;
use App\Sport_users;
use App\Team;
use App\TeamUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    public function showUpdateProfile()
    {
        $user = Auth::user();
        $user_id = $user->id;

        if ($user->roles_id == 5){
            $roles = Role::all()->except([1, 4]);
        }else{
            $roles = Role::all()->except([1, 5]);
        }

        $countries = Countries::all();
        $sports = Sport::where('status', '=', 1)->where('type', '=', 'فرديه')->get();
        $teamsports = $user->sports()->wherePivot('type', '=', 'جماعيه')->get();
        $teams = Team::where('status', '=', 1)->get();
        $team_sports = Sport::where('status', '=', 1)->where('type', '=', 'جماعيه')->get();

        foreach ($user->sports as $sport) {
            $sports_ids[] = $sport->id;
        }
        foreach ($user->teams as $team) {
            $teams_ids[] = $team->id;
        }
        if (!isset($sports_ids)) {
            $sports_ids = [];
        }
        if (!isset($teams_ids)) {
            $teams_ids = [];
        }


        return view('frontEnd.users.updateProfile', compact('team_sports', 'user_id', 'roles', 'countries', 'sports', 'teams', 'user', 'sports_ids', 'teams_ids', 'teamsports'));
    }

    public function UpdateProfileInfo(Request $request, $id)
    {
//        return $request;
        $this->Validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'image1' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'Cv' => 'mimes:doc,pdf,docx,zip',
            'country_id' => 'required',
            'govarea_id' => 'required',
            'city_id' => 'required',
            'roles_id' => 'required',

        ], [
            'name.required' => 'من فضلك ادخل الاسم',
            'name.string' => ' يجب ان يكون الاسم عبارة عن نص',
            'name.max' => ' يجب ان لا يزيد الاسم عن 255 حرف',
            'password.required' => 'من فضلك قم بادخال كلمة المرور',
            'password.string' => 'يجب ان تحتوى كلمة المرور على احرف',
            'password.min' => 'يجب ان تتكون كلة المرور على الاقل من 6 احرف',
            'password.confirmed' => 'كلمة المرور غير مطابقة , قم باعادة المحاولة',
            'image1.image' => 'هذة ليست بصورة ',
            'image1.mimes' => 'لقد قمت باختيار نوع غير مدعوم من الصور',
            'Cv.mimes' => 'هذا النوع من الملفات غير مدعوم ',
            'country_id.required' => ' من فضلك قم باختيار الدولة',
            'city_id.required' => ' من فضلك قم بادخال اسم مدينتك',
            'govarea_id.required' => ' من فضلك قم بادخال اسم منطقتك',
            'roles_id' => 'من فضلك قم باختيار عضويتك',
        ], [
        ]);

        if ($request->roles_id == 4 || $request->roles_id == 5) {
            if ($request->sports == NULL && $request->team_sports_chks == NULL) {
                return back()->withErrors(['من فضلك قم باختيار ايا من الرياضات و الفرق التى تود الانتماء اليهم ']);
            }
        }
        $user = User::find($id);

        if (request()->hasfile('image1')) {

            File::delete($user->image);
            $img = request()->file('image1');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/profileImages/'), 'img_' . time() . "." . $ext);
            $profile_img_path = 'uploads/images/profileImages/img_' . time() . "." . $ext;
        } else {

            if (strpos($user->image, 'design/frontEnd/images') !== false) {

                if ($request->roles_id == 2) {
                    if ($request->user_type == 'ذكر') {
                        $profile_img_path = 'design/frontEnd/images/fans man.png';
                    } else {
                        $profile_img_path = 'design/frontEnd/images/fans girl.png';
                    }
                } elseif ($request->roles_id == 3) {
                    if ($request->user_type == 'ذكر') {
                        $profile_img_path = 'design/frontEnd/images/bussnis man.png';
                    } else {
                        $profile_img_path = 'design/frontEnd/images/bussnis girl.png';
                    }
                } elseif ($request->roles_id == 4 || $request->roles_id ==5) {
                    if ($request->user_type == 'ذكر') {
                        $profile_img_path = 'design/frontEnd/images/players.png';
                    } else {
                        $profile_img_path = 'design/frontEnd/images/players_girl.png';
                    }
                }
            } else {
                $profile_img_path = $user->image;
            }
        }

        if ($request->hasFile('Cv')) {

            File::delete($user->cv_link);
            $cv_file = request()->file('Cv');
            $ext = strtolower($cv_file->getClientOriginalExtension());

            $cv_file->move(public_path('uploads/files/userCVs/'), 'cv_' . time() . "." . $ext);
            $cv_path = 'uploads/files/userCVs/cv_' . time() . "." . $ext;
        } else {
            $cv_path = $user->cv_link;
        }

        $user->name = $request->name;
        $user->image = $profile_img_path;
        $user->cv_link = $cv_path;
        $user->countries_id = $request->country_id;
        $user->govarea_id = $request->govarea_id;
        $user->city_id = $request->city_id;
        $user->status = $user->status;
        $user->roles_id = $request->roles_id;
        $user->password = Hash::make($request->password);
        $user->plain_password = $request->password;

        $user->save();


        Sport_users::where('user_id', '=', $request->user_id)->delete();
        TeamUser::where('user_id', '=', $request->user_id)->delete();

        if ($request->roles_id == 4 || $request->roles_id == 5) {
            if (isset($request->team_sports_chks)) {
                foreach ($request->team_sports_chks as $sport_id) {
                    $b = 'teams' . $sport_id;
                    $spor = Sport::find($sport_id);
                    if (!isset($request->$b) && count($spor->teams) > 0) {
                        $errors[] = 'قم باختيار الفريق التى تود الانضمام اليه لرياضة ' . Sport::find($sport_id)->name;
                    }
                }
            }

            if (isset($errors)) {
                return back()->withErrors($errors);
            }


            if (isset($request->sports) || isset($request->team_sports_chks)) {
                Sport_users::where('user_id', '=', $request->user_id)->delete();
            }

            if (isset($request->sports)) {
                foreach ($request->sports as $sport_id)
                    Sport_users::create([
                        'sport_id' => $sport_id,
                        'user_id' => \auth()->user()->id,
                        'type' => 'فرديه',
                        'status' => 1,
                    ]);
            }

            if (isset($request->team_sports_chks)) {
                TeamUser::where('user_id', '=', $request->user_id)->delete();
                foreach ($request->team_sports_chks as $sport_id) {

                    Sport_users::create([
                        'sport_id' => $sport_id,
                        'user_id' => \auth()->user()->id,
                        'type' => 'جماعيه',
                        'status' => 1,
                    ]);
                    if (count(Sport::find($sport_id)->teams) > 0) {
                        TeamUser::create([
                            'team_id' => request('teams' . $sport_id),
                            'user_id' => \auth()->user()->id,
                            'status' => 1,
                        ]);
                    }
                }
            }

        }
        session()->flash('message', 'تم تعديل بياناتك بنجاح');
        return \redirect('personal/info');
    }

    public function showProfilePreview($id)
    {
        $events_per_page = 2;
        $groups_per_page = 2;
        $teams_per_page = 2;
        $images_per_page = 3;
        $videos_per_page = 2;
        $articles_per_page = 2;

        $user = User::find($id);
        $events = $user->events()->wherePivot('status', '=', '1')->paginate($events_per_page);
        $groups = $user->groups()->wherePivot('status', '=', '1')->paginate($groups_per_page);
        $teams = $user->teams()->wherePivot('status', '=', '1')->paginate($teams_per_page);
        $images = $user->medias()->where('type', '=', 'صورة')->where('status', '=', 1)->paginate($images_per_page);
        $videos = $user->medias()->where('type', '=', 'فيديو')->where('status', '=', 1)->paginate($videos_per_page);
        $articles = $user->articles()->where('status', '=', '1')->paginate($articles_per_page);

        $events_count = $user->events()->wherePivot('status', '=', '1')->count();
        $groups_count = $user->groups()->wherePivot('status', '=', '1')->count();
        $teams_count = $user->teams()->wherePivot('status', '=', '1')->count();
        $images_count = $user->medias()->where('type', '=', 'صورة')->where('status', '=', 1)->count();
        $videos_count = $user->medias()->where('type', '=', 'فيديو')->where('status', '=', 1)->count();
        $articles_count = $user->articles()->where('status', '=', '1')->count();

        $count_res = [
            'eve' => ceil($events_count / $events_per_page),
            'grou' => ceil($groups_count / $groups_per_page),
            'tea' => ceil($teams_count / $teams_per_page),
            'img' => ceil($images_count / $images_per_page),
            'vid' => ceil($videos_count / $videos_per_page),
            'art' => ceil($articles_count / $articles_per_page)
        ];

        $max_length = array_search(max($count_res), $count_res);

        return view('frontEnd.users.ProfilePreview', compact('user', 'events', 'groups', 'teams', 'images', 'videos', 'articles', 'max_length'));
    }

    public function showPersonalInfo()
    {
        $user = Auth::user();
        return view('frontEnd.users.personalInfo', compact('user'));
    }

    public function showRequests()
    {
        $user = Auth::user();
        $groups = Group::where(['admin_id' => $user->id, 'status' => 1])->get();
        $teams = Team::where(['admin_id' => $user->id, 'status' => 1])->get();
        $events = Event::where(['user_id' => $user->id, 'status' => 1])->get();

        return view('frontEnd.users.requests', compact('groups', 'teams', 'events'));
    }

    public function approveGroupJoin($group_id, $user_id)
    {
        $group_user = GroupUser::where(['user_id' => $user_id, 'group_id' => $group_id])->get()->first();
        $group_user->status = 1;
        $group_user->save();

        $user = User::find($user_id);
        $group = Group::find($group_id);
        $user->notify(new joinAccept(Auth::user(), $group, 'group'));

        session()->flash('message', 'تم تفعيل انضمام العضو للمجموعة !');
        $url = URL::to(url()->previous()) . '#scroll_tbl';
        return Redirect::to($url);
    }

    public function removeGroupJoin($group_id, $user_id)
    {
        $group_user = GroupUser::where(['user_id' => $user_id, 'group_id' => $group_id])->get()->first();
        $group_user->delete();
        session()->flash('message', 'تم حذف طلب الانضمام !');
        $url = URL::to(url()->previous()) . '#scroll_tbl';
        return Redirect::to($url);
    }

    public function approveTeamJoin($team_id, $user_id)
    {
        $team_user = TeamUser::where(['user_id' => $user_id, 'team_id' => $team_id])->get()->first();
        $team_user->status = 1;
        $team_user->save();

        $user = User::find($user_id);
        $team = Team::find($team_id);
        $user->notify(new joinAccept(Auth::user(), $team, 'team'));

        session()->flash('message', 'تم تفعيل انضمام العضو للفريق !');
        $url = URL::to(url()->previous()) . '#scroll_tbl';
        return Redirect::to($url);
    }

    public function removeTeamJoin($team_id, $user_id)
    {
        $team_user = TeamUser::where(['user_id' => $user_id, 'team_id' => $team_id])->get()->first();
        $team_user->delete();
        session()->flash('message', 'تم حذف طلب الانضمام !');
        $url = URL::to(url()->previous()) . '#scroll_tbl';
        return Redirect::to($url);
    }

    public function approveEventJoin($event_id, $user_id)
    {
        $event_user = Event_user::where(['user_id' => $user_id, 'event_id' => $event_id])->get()->first();
        $event_user->status = 1;
        $event_user->save();

        $user = User::find($user_id);
        $event = Event::find($event_id);
        $user->notify(new joinAccept(Auth::user(), $event, 'event'));

        session()->flash('message', 'تم تفعيل انضمام العضو للفاعلية !');
        $url = URL::to(url()->previous()) . '#scroll_tbl';
        return Redirect::to($url);
    }

    public function removeEventJoin($event_id, $user_id)
    {
        $event_user = Event_user::where(['user_id' => $user_id, 'event_id' => $event_id])->get()->first();
        $event_user->delete();
        session()->flash('message', 'تم حذف طلب الانضمام !');
        $url = URL::to(url()->previous()) . '#scroll_tbl';
        return Redirect::to($url);
    }


}
