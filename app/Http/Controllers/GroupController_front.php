<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupUser;
use App\Notification;
use App\Notifications\joinRequest;
use App\Sport;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class GroupController_front extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $groups = $user->groups()->wherePivot('status','=',1)->paginate(8);
        $admin_groups = Group::where(['admin_id' => $user->id, 'status' => 1 ])->paginate(8);
        $teams = $user->teams()->where('admin_id','=',$user->id)->wherePivot('status','=',1)->get();

     //   $teams = Team::where(['admin_id' => $user->id, 'status' => 1 ])->get();
        $sports =$user->sports()->wherePivot('status','=',1)->wherePivot('type','=','فرديه')->get();

        return view('frontEnd.group.group-profile', compact('user','groups','admin_groups','teams','sports'));

    }

    public function show($id)
    {
        $group = Group::find($id);

        $users_per_page = 8;
        $articles_per_page = 4;
        $videos_per_page = 6;

        $users = $group->users()->wherePivot('status','=',1)->paginate($users_per_page);
        $articles = $group->articles()->where('status','=',1)->paginate($articles_per_page);
        $videos = $group->medias()->where(['status'=> 1, 'type'=>'فيديو'])->paginate($videos_per_page);

        $users_count = $group->users()->wherePivot('status','=',1)->count();
        $articles_count =  $group->articles()->where('status','=',1)->count();
        $videos_count =  $group->medias()->where(['status'=> 1, 'type'=>'فيديو'])->count();


        $count_res = [
            'us' => ceil($users_count / $users_per_page),
            'art' => ceil($articles_count / $articles_per_page),
            'vid' => ceil($videos_count / $videos_per_page),
        ];

        $max_length = array_search(max($count_res), $count_res);

        return view('frontEnd.group.group-details',compact('group','users','articles','videos','max_length'));
    }

    public function create()
    {
        $teams = Team::all();
        $sports = Sport::all();

        return view('admin.groups.createGroup', compact('teams', 'sports'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'group_name' => 'required',
            'description' => 'required',
            'sport_id' => 'required_if:group_to,==,sport',
            'team_id' => 'required_if:group_to,==,team',
            'groupImg' => 'required|mimes:jpeg,jpg,png,gif|max:100000',
        ], [
            'group_name.required' => 'من فضلك ادخل اسم المجموعة',
            'description.required' => 'من فضلك ادخل وصف المجموعة',
            'sport_id.required_if' => 'من فضلك قم باختيار الرياضة التى تود انشاء المجموعة لها',
            'team_id.required_if' => 'من فضلك اختر الفريق التى تنتمى اليه هذة لمجموعة',
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

        if ($request->group_to == 'team') {

            $team = Team::find($request->team_id);

            Group::create([
                'name' => $request->group_name,
                'description' => $request->description,
                'status' => 1,
                'team_id' => $request->team_id,
                'sport_id' => $team->sport_id,
                'admin_id' => $team->admin_id,
                'user_id' => Auth::user()->id,
                'image_url' => $group_img_path,
            ]);
     
        } elseif ($request->group_to == 'sport') {
            Group::create([
                'name' => $request->group_name,
                'description' => $request->description,
                'status' => 1,
                'sport_id' => $request->sport_id,
                'user_id' => Auth::user()->id,
                'admin_id' =>Auth::user()->id,
                'image_url' => $group_img_path,
            ]);
        }

    }

    public function edit($id)
    {
        $teams = Team::all();
        $sports = Sport::all();
        $group = Group::find($id);

        $all_team_users = Team::find($group->team_id)->users;
        $group_users = Group::find($id)->users;
        $other_users = array();

        if (count($group_users) != 0) {
            foreach ($group_users as $user) {
                $group_mem_ids [] = $user->id;
            }
            if (count($group_mem_ids) != 0) {
                foreach ($all_team_users as $user) {
                    if (!in_array($user->id, $group_mem_ids)) {
                        $other_users[] = $user;
                    }
                }
            }
        } else {
            $other_users = $all_team_users;
        }


        return view('admin.groups.editGroup', compact('group', 'teams', 'sports', 'group_users', 'other_users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::find($id);
        $group->name = $request->name;
        $group->description = $request->description;
        $group->sport_id = $request->sport_id;
        $group->team_id = $request->team_id;

        if ($request->hasFile('groupImg')) {
            $filename = $request->groupImg->getClientOriginalName();
            $request->groupImg->storeAs('public/upload/images', $filename);
            $group->image_url = asset('storage/upload/images/' . $filename);
        } else {
            $group->image_url = $group->image_url;
        }

        $group->save();
        session()->flash('message', 'تم تعديل البيانات بنجاح');
        return redirect('groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::find($id)->delete();
        DB::table('group_user')->where(['group_id' => $id])->delete();
        session()->flash('message', 'تم حذف بيانات الجروب بنجاح');
        return back();
    }

    public function getTeamMembers()
    {
        $users = Team::find(request('teamID'))->users;
        return response($users);

    }

    public function add_group_member($group_id, $user_id, $mem_type)
    {
        GroupUser::create(
            [
                'user_id' => $user_id,
                'group_id' => $group_id,
                'type' => $mem_type,
            ]
        );
        session()->flash('message', 'تم اضافة العضو بنجاح');
        return back();
    }

    public function delete_group_member($group_id, $user_id)
    {
        DB::table('group_user')->where(['group_id' => $group_id, 'user_id' => $user_id])->delete();
        session()->flash('message', 'تم الحذف بنجاح');
        return back();
    }

    public function active($id)
    {
        $group = Group::find($id);
        $group->status = 0;
        $group->save();

        session()->flash('message', 'تم الغاء تفعيل الجروب');
        return back();
    }

    public function unactive($id)
    {
        $group = Group::find($id);
        $group->status = 1;
        $group->save();


        session()->flash('message', 'تم تفعيل الجروب بنجاح');
        return back();
    }

    public function joinGroup($id)
    {
        GroupUser::create([
            'group_id' => $id,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);

        $group = Group::find($id);
        $group_admin = $group->groupAdmin;

        $group_admin->notify(new joinRequest(Auth::user(), $group, 'group'));

        session()->flash('message', 'تم ارسال طلب الانضمام للفريق !');
        $url = URL::to(url()->previous()) . '#scroll_group';
        return Redirect::to($url);
    }

    public function disJoinGroup($id)
    {
        GroupUser::where('group_id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();

        $notifications = Notification::all();

        foreach ($notifications as $notification) {
            if (json_decode($notification->data, true)['user']['id'] == Auth::user()->id &&
                json_decode($notification->data, true)['joined']['id'] == $id) {
                $notification->delete();
            }
        }

        session()->flash('message', 'تم الغاء انضمامك للفريق !');
        $url = URL::to(url()->previous()) . '#scroll_group';
        return Redirect::to($url);
    }

    public function deleUser($group_id, $user_id)
    {
        GroupUser::where('group_id', '=', $group_id)->where('user_id', '=', $user_id)->delete();

        session()->flash('message', 'تم حذف العضو من المجموعة !');
        $url = URL::to(url()->previous()) . '#scroll_mem';
        return Redirect::to($url);
    }

}
