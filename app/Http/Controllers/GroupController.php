<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupUser;
use App\Sport;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return view('admin.groups.groupManagment', compact('groups'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        $sports = Sport::where('type', '=', 'فرديه')->get();
        $users = User::where('roles_id', '=', '5')->get();

        return view('admin.groups.createGroup', compact('teams', 'sports', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'group_name' => 'required',
            'description' => 'required',
            'sport_id' => 'required_if:group_to,==,sport',
            'admin_id' => 'required_if:group_to,==,sport',
            'team_id' => 'required_if:group_to,==,team',
            'groupImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
        ], [
            'group_name.required' => 'من فضلك ادخل اسم المجموعة',
            'description.required' => 'من فضلك ادخل وصف المجموعة',
            'sport_id.required_if' => 'من فضلك قم باختيار الرياضة التى تود انشاء المجموعة لها',
            'admin_id.required_if' => 'من فضلك اضف ادمن للمجموعة',
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
                'status' => $request->status,
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
                'status' => $request->status,
                'sport_id' => $request->sport_id,
                'user_id' => Auth::user()->id,
                'admin_id' => $request->admin_id,
                'image_url' => $group_img_path,
            ]);
        }

        session()->flash('message', 'تم اضافة الجروب');
        return redirect('admin/groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teams = Team::all();
        $sports = Sport::where('type', '=', 'فرديه')->get();
        $users = User::where('roles_id', '=', '5')->get();
        $group = Group::find($id);

        return view('admin.groups.editGroup', compact('group', 'teams', 'sports', 'users'));
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'sport_id' => 'required_if:group_to,==,sport',
            'admin_id' => 'required_if:group_to,==,sport',
            'team_id' => 'required_if:group_to,==,team',
            'groupImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
        ], [
            'name.required' => 'من فضلك ادخل اسم المجموعة',
            'description.required' => 'من فضلك ادخل وصف المجموعة',
            'sport_id.required_if' => 'من فضلك قم باختيار الرياضة التى تود انشاء المجموعة لها',
            'admin_id.required_if' => 'من فضلك اضف ادمن للمجموعة',
            'team_id.required_if' => 'من فضلك اختر الفريق التى تنتمى اليه هذة لمجموعة',
            'groupImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لتلك المجموعة لهذا لن تتم اضافته , من فضلك قم باختيار صورة اخرى للمجموعة',
        ], [

        ]);

        $group = Group::find($id);

        if (request()->hasfile('groupImg')) {

            File::delete($group->image_url);

            $img = request()->file('groupImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/groupImages/'), 'img_' . time() . "." . $ext);
            $group_img_path = 'uploads/images/groupImages/img_' . time() . "." . $ext;
        } else {
            $group_img_path = $group->image_url;
        }

        if ($request->group_to == 'team') {

            $team = Team::find($request->team_id);

            $group->name = $request->name;
            $group->description = $request->description;
            $group->status = $request->status;
            $group->team_id = $request->team_id;
            $group->sport_id = $team->sport_id;
            $group->admin_id = $team->admin_id;
            $group->image_url = $group_img_path;

        } elseif ($request->group_to == 'sport') {

            $group->name = $request->name;
            $group->description = $request->description;
            $group->status = $request->status;
            $group->team_id = NULL;
            $group->sport_id = $request->sport_id;
            $group->admin_id = $request->admin_id;
            $group->image_url = $group_img_path;
        }

        $group->save();
        session()->flash('message', 'تم تعديل البيانات بنجاح');
        return redirect('admin/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();
        File::delete($group->image_url);

        DB::table('group_user')->where(['group_id' => $id])->delete();
        session()->flash('message', 'تم حذف بيانات الجروب بنجاح');
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

    public function showMedia($id)
    {
        $group_id = $id;
        $medias = Group::find($id)->medias;
        $groupName = Team::find($id)->name;
        return view('admin/media/groupMedia', compact('medias', 'group_id','groupName'));
    }
}
