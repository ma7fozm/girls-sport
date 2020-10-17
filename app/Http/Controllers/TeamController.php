<?php

namespace App\Http\Controllers;

use App\Sport;
use App\Team;
use App\Team_User;
use App\TeamUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Helper\Table;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('admin.teams.teamsManagment', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('roles_id', '=', '5')->get();
        $sports = Sport::where('type', '=', 'جماعيه')->get();
        return view('admin.teams.createTeam', compact('users', 'sports'));
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
            'name' => 'required',
            'description' => 'required',
            'admin_id' => 'required|not_in:0',
            'sport_id' => 'required|not_in:0',
            'teamSlogan' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
        ], [
            'name.required' => 'من فضلك ادخل اسم الفريق',
            'description.required' => 'من فضلك ادخل وصف للفريق',
            'admin_id.not_in' => 'من فضلك قم باضافة ادمن للفريق',
            'sport_id.not_in' => 'من فضلك قم باختيار رياضة للفريق',
            'teamSlogan.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور الدال على شعار هذا الفريق لذلك لن تتم اضافته , "اختر صورة اخرى" ',
        ], [

        ]);

        if (request()->hasfile('teamSlogan')) {

            $slogan = request()->file('teamSlogan');
            $ext = strtolower($slogan->getClientOriginalExtension());

            $slogan->move(public_path('uploads/images/teamSlogans/'), 'slogan_' . time() . "." . $ext);
            $teamSlogan_path = 'uploads/images/teamSlogans/slogan_' . time() . "." . $ext;
        } else {
            $teamSlogan_path = NULL;
        }

        Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'slogan' => $teamSlogan_path,
            'sport_id' => $request->sport_id,
            'user_id' => Auth::user()->id,
            'admin_id' => $request->admin_id,

        ]);


        session()->flash('message', 'تم اضافة الفريق');
        return redirect('admin/teams');
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
        $team = Team::find($id);
        $users = User::where('roles_id', '=', 5)->get();
        $sports = Sport::where('type', '=', 'جماعيه')->get();

        return view('admin.teams.editTeam', compact('team', 'sports', 'users'));
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
            'admin_id' => 'required|not_in:0',
            'sport_id' => 'required|not_in:0',
            'teamSlogan' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
        ], [
            'name.required' => 'من فضلك ادخل اسم الفريق',
            'description.required' => 'من فضلك ادخل وصف للفريق',
            'admin_id.not_in' => 'من فضلك قم باضافة ادمن للفريق',
            'sport_id.not_in' => 'من فضلك قم باختيار رياضة للفريق',
            'teamSlogan.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور الدال على شعار هذا الفريق لذلك لن تتم اضافته , "اختر صورة اخرى" ',
        ], [

        ]);

        $team = Team::find($id);

        if (request()->hasfile('teamSlogan')) {

            File::delete($team->slogan);

            $slogan = request()->file('teamSlogan');
            $ext = strtolower($slogan->getClientOriginalExtension());

            $slogan->move(public_path('uploads/images/teamSlogans/'), 'slogan_' . time() . "." . $ext);
            $teamSlogan_path = 'uploads/images/teamSlogans/slogan_' . time() . "." . $ext;
        } else {
            $teamSlogan_path = $team->slogan;
        }

        $team->name = $request->name;
        $team->description = $request->description;
        $team->slogan = $teamSlogan_path;
        $team->status = $request->status;
        $team->sport_id = $request->sport_id;
        $team->admin_id = $request->admin_id;
        $team->save();
        session()->flash('message', 'تم تعديل البيانات بنجاح');
        return redirect('admin/teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        $team->delete();
        File::delete($team->slogan);
//        DB::table('team_user')->where(['team_id' => $id])->delete();
//        DB::table('media')->where(['team_id' => $id])->delete();
        session()->flash('message', 'تم حذف بيانات الفريق بنجاح');
        return back();
    }


    public function active($id)
    {
        $user = Team::find($id);
        $user->status = 0;
        $user->save();

        session()->flash('message', 'تم الغاء تفعيل المجموعة');
        return back();
    }

    public function unactive($id)
    {
        $user = Team::find($id);
        $user->status = 1;
        $user->save();

        session()->flash('message', 'تم تفعيل المجموعة بنجاح');
        return back();
    }

    public function showMedia($id)
    {
        $team_id = $id;
        $medias = Team::find($id)->medias;
        $teamName = Team::find($id)->name;
        return view('admin/media/teamMedia', compact('medias', 'team_id','teamName'));
    }

}
