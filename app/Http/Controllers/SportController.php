<?php

namespace App\Http\Controllers;

use App\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sports = Sport::all();
        return view('admin.sports.sportsManagment', compact('sports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sports.createSport');
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
            'sportImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
            'sport_type' => 'required',

        ], [
            'name.required' => 'من فضلك ادخل اسم اللعبة',
            'description.required' => 'من فضلك ادخل وصف اللعبة',
            'sportImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لتلك اللعبة لهذا لن تتم اضافته , من فضلك قم باختيار صورة اخرى لهذة اللعبة',
            'sport_type.required' => 'من فضلك قم باختيار نوع اللعبة',
        ], [

        ]);

        if (request()->hasfile('sportImg')) {

            $img = request()->file('sportImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/sportImages/'), 'img_' . time() . "." . $ext);
            $sport_img_path = 'uploads/images/sportImages/img_' . time() . "." . $ext;
        } else {
            $sport_img_path = NULL;
        }

        Sport::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'type' => $request->sport_type,
            'image' => $sport_img_path,
            'user_id' => Auth::user()->id,

        ]);


        session()->flash('message', 'تم اضافة اللعبة بنجاح');
        return redirect('admin/sports');
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
        $sport = Sport::find($id);
        return view('admin.sports.editSport',compact('sport'));
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
//        return $request;
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'sportImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
        ], [
            'name.required' => 'من فضلك ادخل اسم اللعبة',
            'description.required' => 'من فضلك ادخل وصف اللعبة',
            'sportImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لتلك اللعبة لهذا لن تتم اضافته , من فضلك قم باختيار صورة اخرى لهذة اللعبة',
        ], [

        ]);

        $sport = Sport::find($id);

        if (request()->hasfile('sportImg')) {

            File::delete($sport->image);
            $img = request()->file('sportImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/sportImages/'), 'img_' . time() . "." . $ext);
            $sport_img_path = 'uploads/images/sportImages/img_' . time() . "." . $ext;
        } else {
            $sport_img_path = $sport->image;
        }

        $sport->name = $request->name;
        $sport->description = $request->description;
        $sport->type = $request->sport_type;
        $sport->status = $request->status;
        $sport->image = $sport_img_path;
        $sport->save();



        session()->flash('message', 'تم تعديل بيانات اللعبة بنجاح');
        return redirect('admin/sports');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sport = Sport::find($id);
        File::delete($sport->image);
        $sport->delete();
        session()->flash('message', 'تم حذف بيانات اللعبة بنجاح');
        return back();
    }

    public function active($id)
    {
        $sport = Sport::find($id);
        $sport->status = 0;
        $sport->save();
        session()->flash('message', 'تم الغاء تفعيل اللعبة');
        return back();
    }

    public function unactive($id)
    {
        $sport = Sport::find($id);
        $sport->status = 1;
        $sport->save();

        session()->flash('message', 'تم تفعيل اللعبة بنجاح');
        return back();
    }
}
