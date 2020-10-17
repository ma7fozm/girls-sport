<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Media;
use App\role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.usersManagment', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Countries::all();
        $roles = Role::all();
        return view('admin.users.createUser', compact(['countries', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'min:6', 'max:20'],
            'email' => ['required', 'email', 'unique:users'],
            'userImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
            'cv' => 'sometimes|mimes:docx,pdf,pptx',
            'country_id' => 'required',
            'govarea_id' => 'required',
            'city_id' => 'required',
            'role_id' => 'required',
            'personal_proof' => 'required_if:role,==,5|mimes:jpeg,jpg,png,gif|max:100000',
            'guarantor_name' => 'required_if:role,==,5',
            'guarantor_email' => 'required_if:role,==,5|nullable|email',
            'guarantor_phone' => 'required_if:role,==,5|nullable|numeric|digits:11',
        ], [
            'name.required' => 'من فضلك ادخل الاسم',
            'username.required' => 'من فضلك ادخل اسم المستخدم',
            'username.unique' => ' اسم المستخدم موجود مسبقا قم باختيار اسم اخر',
            'password.required' => 'من فضلك ادخل كلمة المرور',
            'password.min' => 'يجب ان تحتوى كلمة المرور على 8 احرف على الاقل',
            'password.max' => 'يجب ان تحتوى كلمة المرور على 20 حرف على الاكثر',
            'email.required' => 'من فضلك ادخل االبريد الالكترونى',
            'email.email' => '  البريد الالكترونى غير صحيح',
            'email.unique' => ' هذا البريد الالكترونى تم استخدامه مسبقا ',
            'userImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لهذا لن تتم اضافته , من فضلك قم باختيار صورة شخصية اخرى',
            'cv.mimes' => ' هذا النواع من الملفات غير صالح لهذا لن تتم اضافته , من فضلك قم باختيار ملف صالح للسيرة الذاتية',
            'cv.required' => 'من فضلك اختر السيرة الذاتية الخاصة بالعضو',
            'country_id.required' => 'من فضلك اختر اسم الدولة المنتمى اليها العضو',
            'govarea_id.required' => 'من فضلك اختر اسم النطقة او المحافظة المنتمى اليها العضو',
            'city_id.required' => 'من فضلك ادخل اسم المدينة',
            'role_id.required' => 'من فضلك اختر نوع العضو',
            'personal_proof.required_if' => 'من فضلك قم بتحديد اثبات شخصية للعضو',
            'guarantor_name.required_if' => 'من فضلك قم بادخال اسم الضامن',
            'guarantor_email.required_if' => 'من فضلك قم بادخال البريد الالكترونى لضامن العضو',
            'guarantor_email.email' => 'من فضلك قم بادخال البريد الالكترونى صالح لضامن العضو',
            'guarantor_phone.required_if' => 'من فضلك قم بادخال رقم جوال الضامن',
            'guarantor_phone.numeric' => 'يجب ان يحتوى رقم الجوال على ارقام فقط',
            'guarantor_phone.digits' => 'يجب ان يحتوى رقم الجوال على 11 رقم',
        ], [

        ]);


        if (request()->hasfile('userImg')) {

            $img = request()->file('userImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/profileImages/'), 'img_' . time() . "." . $ext);
            $profile_img_path = 'uploads/images/profileImages/img_' . time() . "." . $ext;

        } else {

            if ($request->role_id == 2) {

                if ($request->user_type == 'ذكر') {
                    $profile_img_path = 'design/frontEnd/images/fans man.png';
                } else {
                    $profile_img_path = 'design/frontEnd/images/fans girl.png';
                }
            } elseif ($request->role_id == 2) {
                if ($request->user_type == 'ذكر') {
                    $profile_img_path = 'design/frontEnd/images/bussnis man.png';
                } else {
                    $profile_img_path = 'design/frontEnd/images/bussnis girl.png';
                }
            } elseif ($request->role_id == 4) {
                if ($request->user_type == 'ذكر') {
                    $profile_img_path = 'design/frontEnd/images/players.png';
                } else {
                    $profile_img_path = 'design/frontEnd/images/players_girl.png';
                }
            }
        }

        if ($request->hasFile('cv')) {
            $cv_file = request()->file('cv');
            $ext = strtolower($cv_file->getClientOriginalExtension());

            $cv_file->move(public_path('uploads/files/userCVs/'), 'cv_' . time() . "." . $ext);
            $cv_path = 'uploads/files/userCVs/cv_' . time() . "." . $ext;
        } else {
            $cv_path = NULL;
        }

        if (request()->hasfile('personal_proof')) {

            $img = request()->file('personal_proof');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/personalProofs/'), 'img_' . time() . "." . $ext);
            $personalProof_path = 'uploads/images/personalProofs/img_' . time() . "." . $ext;
        } else {
            $personalProof_path = NULL;
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'plain_password' => $request->password,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'cv_link' => $cv_path,
            'image' => $profile_img_path,
            'countries_id' => $request->country_id,
            'govarea_id' => $request->govarea_id,
            'city_id' => $request->city_id,
            'status' => $request->status,
            'type' => $request->user_type,
            'roles_id' => $request->role_id,
            'personal_proof' => $personalProof_path,
            'guarantor_name' => $request->guarantor_name,
            'guarantor_email' => $request->guarantor_email,
            'guarantor_phone' => $request->guarantor_phone,
        ]);

        session()->flash('message', 'تم اضافة العضو بنجاح');
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        $countries = Countries::all();
        $roles = Role::all();
        $user = User::find($id);
        return view('admin.users.editUser', compact('user', 'countries', 'roles'));
    }


    public
    function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user->personal_proof != NULL) {
            $this->validate($request, [
                'name' => 'required',
                'userImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
                'cv' => 'sometimes|mimes:docx,pdf,pptx',
                'country_id' => 'required',
                'govarea_id' => 'required',
                'city_id' => 'required',
                'roles_id' => 'required',
                'guarantor_name' => 'required_if:role,==,5',
                'guarantor_email' => 'required_if:role,==,5|nullable|email',
                'guarantor_phone' => 'required_if:role,==,5|nullable|numeric|digits:11',
            ], [
                'name.required' => 'من فضلك ادخل الاسم',
                'username.unique' => ' اسم المستخدم موجود مسبقا قم باختيار اسم اخر',
                'userImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لهذا لن تتم اضافته , من فضلك قم باختيار صورة شخصية اخرى',
                'cv.mimes' => ' هذا النواع من الملفات غير صالح لهذا لن تتم اضافته , من فضلك قم باختيار ملف صالح للسيرة الذاتية',
                'cv.required' => 'من فضلك اختر السيرة الذاتية الخاصة بالعضو',
                'country_id.required' => 'من فضلك اختر اسم الدولة المنتمى اليها العضو',
                'govarea_id.required' => 'من فضلك اختر اسم المحافظة/المنطقة المنتمى اليها العضو',
                'city_id.required' => 'من فضلك ادخل اسم المدينة',
                'roles_id.required' => 'من فضلك اختر نوع العضو',
                'guarantor_name.required_if' => 'من فضلك قم بادخال اسم الضامن',
                'guarantor_email.required_if' => 'من فضلك قم بادخال البريد الالكترونى لضامن العضو',
                'guarantor_email.email' => 'من فضلك قم بادخال البريد الالكترونى صالح لضامن العضو',
                'guarantor_phone.required_if' => 'من فضلك قم بادخال رقم جوال الضامن',
                'guarantor_phone.numeric' => 'يجب ان يحتوى رقم الجوال على ارقام فقط',
                'guarantor_phone.digits' => 'يجب ان يحتوى رقم الجوال على 11 رقم',
            ], [

            ]);
        } else {
            $this->validate($request, [
                'name' => 'required',
                'userImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
                'cv' => 'sometimes|mimes:docx,pdf,pptx',
                'country_id' => 'required',
                'govarea_id' => 'required',
                'city_id' => 'required',
                'roles_id' => 'required',
                'personal_proof' => 'required_if:role,==,5|mimes:jpeg,jpg,png,gif|max:100000',
                'guarantor_name' => 'required_if:role,==,5',
                'guarantor_email' => 'required_if:role,==,5|nullable|email',
                'guarantor_phone' => 'required_if:role,==,5|nullable|numeric|digits:11',
            ], [
                'name.required' => 'من فضلك ادخل الاسم',
                'username.unique' => ' اسم المستخدم موجود مسبقا قم باختيار اسم اخر',
                'userImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لهذا لن تتم اضافته , من فضلك قم باختيار صورة شخصية اخرى',
                'cv.mimes' => ' هذا النواع من الملفات غير صالح لهذا لن تتم اضافته , من فضلك قم باختيار ملف صالح للسيرة الذاتية',
                'cv.required' => 'من فضلك اختر السيرة الذاتية الخاصة بالعضو',
                'country_id.required' => 'من فضلك اختر اسم الدولة المنتمى اليها العضو',
                'govarea_id.required' => 'من فضلك اختر اسم المحافظة/المنطقة المنتمى اليها العضو',
                'city_id.required' => 'من فضلك ادخل اسم المدينة',
                'roles_id.required' => 'من فضلك اختر نوع العضو',
                'personal_proof.required_if' => 'من فضلك قم بتحديد اثبات شخصية للعضو',
                'guarantor_name.required_if' => 'من فضلك قم بادخال اسم الضامن',
                'guarantor_email.required_if' => 'من فضلك قم بادخال البريد الالكترونى لضامن العضو',
                'guarantor_email.email' => 'من فضلك قم بادخال البريد الالكترونى صالح لضامن العضو',
                'guarantor_phone.required_if' => 'من فضلك قم بادخال رقم جوال الضامن',
                'guarantor_phone.numeric' => 'يجب ان يحتوى رقم الجوال على ارقام فقط',
                'guarantor_phone.digits' => 'يجب ان يحتوى رقم الجوال على 11 رقم',
            ], [

            ]);
        }

        if (request()->hasfile('userImg')) {

            File::delete($user->image);
            $img = request()->file('userImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/profileImages/'), 'img_' . time() . "." . $ext);
            $profile_img_path = 'uploads/images/profileImages/img_' . time() . "." . $ext;
        }  else {

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
                } elseif ($request->roles_id == 4 || $request->roles_id == 5) {
                    if ($request->user_type == 'ذكر') {
                        $profile_img_path = 'design/frontEnd/images/players.png';
                    } else {
                        $profile_img_path = 'design/frontEnd/images/players_girl.png';
                    }
                }
            }else{
                $profile_img_path = $user->image;
            }
        }

        if ($request->hasFile('cv')) {

            File::delete($user->cv_link);
            $cv_file = request()->file('cv');
            $ext = strtolower($cv_file->getClientOriginalExtension());

            $cv_file->move(public_path('uploads/files/userCVs/'), 'cv_' . time() . "." . $ext);
            $cv_path = 'uploads/files/userCVs/cv_' . time() . "." . $ext;
        } else {
            $cv_path = $user->cv_link;
        }

        if (request()->hasfile('personal_proof')) {

            File::delete($user->personal_proof);
            $img = request()->file('personal_proof');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/personalProofs/'), 'img_' . time() . "." . $ext);
            $personalProof_path = 'uploads/images/personalProofs/img_' . time() . "." . $ext;
        } else {
            $personalProof_path = $user->personal_proof;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->image = $profile_img_path;
        $user->cv_link = $cv_path;
        $user->countries_id = $request->country_id;
        $user->govarea_id = $request->govarea_id;
        $user->city_id = $request->city_id;
        $user->status = $request->status;
        $user->roles_id = $request->roles_id;
        $user->personal_proof = $personalProof_path;
        $user->guarantor_name = $request->guarantor_name;
        $user->guarantor_email = $request->guarantor_email;
        $user->guarantor_phone = $request->guarantor_phone;

        if ($request->roles_id != 5) {
            File::delete($user->personal_proof);
            $user->personal_proof = NULL;
            $user->guarantor_name = NULL;
            $user->guarantor_email = NULL;
            $user->guarantor_phone = NULL;
        }

        if (isset($request->password)) {
            $user->plain_password = $request->password;
            $user->password = Hash::make($request->password);
        }

        $user->save();
        session()->flash('message', 'تم تعديل بيانات العضو بنجاح');
        return redirect('admin/users');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        File::delete($user->image);
        File::delete($user->cv_link);
        File::delete($user->personal_proof);

//        DB::table('media')->where(['user_id' => $id])->delete();
//        DB::table('group_user')->where(['user_id' => $id])->delete();
//        DB::table('team_user')->where(['user_id' => $id])->delete();
        session()->flash('message', 'تم حذف بيانات العضو بنجاح');
        return back();
    }

    public
    function block($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();

        session()->flash('message', 'تم حظر العضو');
        return back();
    }

    public function unblock($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();

        session()->flash('message', 'تم تفعيل العضو بنجاح');
        return back();
    }

    public function showMedia($id)
    {
        $user_id = $id;
        $medias = User::find($id)->medias;
        $userName = User::find($id)->name;
        return view('admin/media/userMedia', compact('medias', 'user_id', 'userName'));
    }

    public function showUserArticles()
    {
        return view('frontEnd.users.userArticle');
    }
}
