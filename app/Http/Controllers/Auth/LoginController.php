<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Role;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('frontEnd.login');
    }



    public function field()
    {
        if(filter_var(request()->username,FILTER_VALIDATE_EMAIL) )
        {
            return 'email';
        }
        else{
            return 'username';
        }
    }

    public function login()
    {
         $this->validate(request(), [
                'password' => 'required',
                'username'=>'required',

            ], [
                'password.required' => 'من فضلك قم بإدخال كلمه المرور',
                'username.required'=>'من فضلك قم بإدخال البريد الالكتروني او اسم المستخدم ',
            ], [

            ]);

        if (Auth::attempt([$this->field() => request()->username, 'password' => request()->password ,'status'=>1])) {
            $user = Auth::user();
            $role = Role::find($user->roles_id);

            //Checking if user is admin
            if ($role->name == 'سوبر ادمن') {
                session()->flash('message','تمت المصادفة بنجاح');
                return redirect()->intended('admin/');

            } else {
                if ($user->frist_log == 1){
                    $user->frist_log = 0;
                    $user->save();
                    session()->flash('message','تم المصادفة بنجاح');
                    return redirect()->intended('update/profile');
                }else{
                    session()->flash('message','تم المصادفة بنجاح');
                    return redirect()->intended('index');
                }

            }
        } else {
            Session::flash('error', 'خطأ في اسم المستخدم او كلمة المرور');
            return redirect()->back();
        }

    }

}
