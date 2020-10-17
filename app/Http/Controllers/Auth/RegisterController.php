<?php

namespace App\Http\Controllers\Auth;

use App\Countries;
use App\Country_City;
use App\Mail\verifyEmail;
use App\Notifications\UserRegisteredSuccessfully;
use App\Sport;
use App\Sport_users;
use App\Team;
use App\TeamUser;
use App\User;
use App\Country;
use App\Role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;


class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(Request $request)
    {

        return $this->Validate($request, [
            'name' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
//            'image1' => 'image|mimes:jpeg,png,jpg,gif,svg',
//            'Cv' => 'mimes:doc,pdf,docx,zip',
            'country_id' => 'required',
            'govarea_id' => 'required',
            'city_id' => 'required',
            'roles_id' => 'required',

        ], [
            'name.required' => 'من فضلك ادخل الاسم',
            'name.alpha' => ' يجب ان يكون الاسم مكون من حروف فقط.',
            'name.max' => ' يجب ان لا يزيد الاسم عن 255 حرف',
            'email.required' => 'من فضلك ادخل البريد الالكترونى',
            'email.string' => 'يجب ان يكون البريد الالكترونى عبارة عن نص',
            'email.email' => 'هذا البريد غير صالح , من فضلك ادخل بريد صحيح',
            'email.max' => 'يجب ان لا يتجاوز عدد احرف البريد الالكترونى عن 255 حرف',
            'email.unique' => 'هذا الايميل تم استخدامه مسبقا , من فضلك قم باختيار ايميل اخر',
            'username.required' => 'من فضلك قم بادخال اسم المستخدم',
            'username.string' => 'يجب ان يكون اسم المستخدم عبارة عن نص',
            'username.unique' => ' اسم المستخدم هذا موجود مسبقا , من فضلك قم باختيار اسم اخر',
            'password.required' => 'من فضلك قم بادخال كلمة المرور',
            'password.string' => 'يجب ان تحتوى كلمة المرور على احرف',
            'password.min' => 'يجب ان تتكون كلة المرور على الاقل من 6 احرف',
            'password.confirmed' => 'كلمة المرور غير مطابقة , قم باعادة المحاولة',
//            'image1.image' => 'هذة ليست بصورة ',
//            'image1.mimes' => 'لقد قمت باختيار نوع غير مدعوم من الصور',
//            'Cv.mimes' => 'هذا النوع من الملفات غير مدعوم ',
            'country_id.required' => ' من فضلك قم باختيار الدولة',
            'govarea_id.required' => ' من فضلك قم بادخال اسم المنطقة/المحافظة',
            'city_id.required' => ' من فضلك قم بادخال اسم المدينة/المحافظة',
//            'city_name.string' => 'يجب ان يكون اسم المدينة عبارة عن نص',
            'roles_id' => 'من فضلك قم باختيار عضويتك',
        ], [

        ]);
    }

    protected function create(Request $request)
    {

//        if (request()->hasfile('image1')) {
//            $img = request()->file('image1');
//            $ext = strtolower($img->getClientOriginalExtension());
//            $img->move(public_path('uploads/images/profileImages/'), 'img_' . time() . "." . $ext);
//            $profile_img_path = 'uploads/images/profileImages/img_' . time() . "." . $ext;
//        } else {
//            $profile_img_path = NULL;
//        }
//
//        if ($request->hasFile('Cv')) {
//            $cv_file = request()->file('Cv');
//            $ext = strtolower($cv_file->getClientOriginalExtension());
//
//            $cv_file->move(public_path('uploads/files/userCVs/'), 'cv_' . time() . "." . $ext);
//            $cv_path = 'uploads/files/userCVs/cv_' . time() . "." . $ext;
//        } else {
//            $cv_path = NULL;
//        }

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
        } elseif ($request->roles_id == 4) {
            if ($request->user_type == 'ذكر') {
                $profile_img_path = 'design/frontEnd/images/players.png';
            } else {
                $profile_img_path = 'design/frontEnd/images/players_girl.png';
            }
        }


        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'plain_password' => $request['password'],
            'countries_id' => $request['country_id'],
            'city_id' => $request['city_id'],
            'govarea_id' => $request['govarea_id'],
            'status' => 0,
            'type' => $request->user_type,
            'frist_log' => 1,

            'image' => $profile_img_path,
            'roles_id' => $request['roles_id'],
            'verify_token' => Str::random(40),
//            'cv_link' =>  ,
            'activation_code' => str_random(30) . time(),

        ]);
//        if ($request->roles_id == 4){
//            if (isset($request->sports) ){
//                foreach ($request->sports as $sport)
//                    Sport_users::create([
//                        'sport_id'=>$sport,
//                        'user_id'=>$user->id,
//                        'type'=>'فرديه',
//                        'status'=>1,
//                    ]);
//            }
//
//            if (isset($request->teamsports) ){
//                foreach ($request->teamsports as $sport)
//                    Sport_users::create([
//                        'sport_id'=>$sport,
//                        'user_id'=>$user->id,
//                        'type'=>'جماعيه',
//                        'status'=>1,
//                    ]);
//            }

//            if (isset($request->teams) ){
//                foreach ($request->teams as $team)
//                    TeamUser::create([
//                        'team_id'=>$team,
//                        'user_id'=>$user->id,
//                        'status'=>1,
//                    ]);
//            }
//        }

        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;

    }

    public function showRegistrationForm()
    {
        $roles = Role::all()->except([1, 5]);
        $countries = Countries::all();
        $sports = Sport::where('status', '=', 1)->where('type', '=', 'فرديه')->get();
        $team_sports = Sport::where('status', '=', 1)->where('type', '=', 'جماعيه')->get();
        $teams = Team::where('status', '=', 1)->get();

        return view('frontEnd.register', compact('roles', 'countries', 'sports', 'teams', 'team_sports'));
    }

    public function register(Request $request)
    {
//        return $request;

        $validator = $this->validator($request);
//        if ($request->roles_id == 4){
//            if ($request->sports == NULL && $request->teams == NULL){
//                return back()->withErrors(['من فضلك قم باختيار ايا من الرياضات التى تود الانتماء اليها ']);
//            }
//        }
        $user = $this->create($request);
        Session::flash('message', 'تم انشاء الحساب بنجاح');
        return redirect(route('verifyEmailFirst', $user->roles_id));
//        Auth::login($user);
        return redirect('update/profile');
    }


    public function activateUser(string $activationCode)
    {
        try {
            $user = app(User::class)->where('activation_code', $activationCode)->first();
            if (!$user) {
                return "The code does not exist for any user in our system.";
            }
            $user->status = 1;
            $user->activation_code = null;
            $user->save();
            auth()->login($user);
        } catch (\Exception $exception) {
            logger()->error($exception);
            return "Whoops! something went wrong.";
        }
        return redirect()->to('/home');
    }

    public function verifyEmailFirst($role_id)
    {
        return view('frontEnd.emails.verifyEmailFirst', compact('role_id'));
    }

    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function sendEmailDone($email, $verifyToken)
    {
        $user = User::where(['email' => $email, 'verify_Token' => $verifyToken])->first();
        if ($user) {
            if ($user->roles_id == 4) {
                return redirect('comp_regist/' . $user->id);
            } else {
                $user->status = 1;
                $user->verify_token = NULL;
                $user->save();
                return redirect('/login');
            }
        } else {
            return 'user not found';
        }
    }

    public function showComRegist($user_id)
    {
        $sports = Sport::where('status', '=', 1)->where('type', '=', 'فرديه')->get();
        $team_sports = Sport::where('status', '=', 1)->where('type', '=', 'جماعيه')->get();
        $teams = Team::where('status', '=', 1)->get();

        return view('frontEnd.compRegist', compact('user_id', 'sports', 'team_sports', 'teams'));
    }


    public function storeComRegist(Request $request)
    {

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
                    'user_id' => $request->user_id,
                    'type' => 'فرديه',
                    'status' => 1,
                ]);
        }

        if (isset($request->team_sports_chks)) {
            TeamUser::where('user_id', '=', $request->user_id)->delete();
            foreach ($request->team_sports_chks as $sport_id) {

                Sport_users::create([
                    'sport_id' => $sport_id,
                    'user_id' => $request->user_id,
                    'type' => 'جماعيه',
                    'status' => 1,
                ]);
                if (count(Sport::find($sport_id)->teams) > 0) {
                    TeamUser::create([
                        'team_id' => request('teams' . $sport_id),
                        'user_id' => $request->user_id,
                        'status' => 1,
                    ]);
                }
            }
        }

        $user = User::find($request->user_id);
        $user->status = 1;
        $user->verify_token = NULL;
        $user->save();

        Session::flash('message', 'تم اكتمال التسجيل وتفعيل عضويتكم بنجاح');
        return redirect('/login');
    }

}
   


