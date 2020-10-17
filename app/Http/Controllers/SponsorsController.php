<?php

namespace App\Http\Controllers;
use App\Sponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SponsorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sponsors = Sponser::all();
        return view('admin.sponsors.SponsorsManagment', compact('sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sponsors.createSponsor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'name' => 'required',
            'sponsorImg' => 'required',
           
        ], [
            'name.required' => 'من فضلك ادخل اسم الراعي ',
           'sponsorImg.required' => 'من فضلك ادخل صوره الراعي',

          
        ], [

        ]);

                 $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];

                    $saved=[
             'name' => $request->name,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
           // 'image' => $img_url,
        ];

        if (request()->hasfile('sponsorImg')) {

            $file = request()->file('sponsorImg');
            $news_name = $request->sponsorImg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/sponsorsImages/'), 'img_' . time() . "." . $ext);
                $news_path = 'uploads/images/sponsorsImages/img_' . time() . "." . $ext;
                  $img_url = $news_path;
                   $saved['image']=$img_url;
                

            } 
        }

      Sponser::create($saved);
      


        session()->flash('message', 'تمت اضافه الراعي بنجاح ');
        return redirect('admin/Sponsors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $sponsor = Sponser::find($id);
    
        return view('admin.sponsors.editSponsor', compact('sponsor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $this->validate($request, [
            'name' => 'required',
   
        ], [
            'name.required' => 'من فضلك ادخل اسم القسم',
            
        ], [

        ]);

        $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];
     if ($request->hasFile('sponsorImg')) {
             
            $fileExtention = strtolower($request->sponsorImg->getClientOriginalExtension());
            if (!in_array($fileExtention, $imgExt)) {
                $validationErrors[] = 'هذة ليست بصورة او انك قمت باختيار صورة غير مدعومة';
            }
        }



         $sponsor = Sponser::find($id);

        $sponsor->name = $request->name;
     
        $sponsor->status = $request->status;

           if (request()->hasfile('sponsorImg')) {
             File::delete($sponsor->image);
            $file = request()->file('sponsorImg');
            $sponsor_name = $request->sponsorImg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/sponsorsImages/'), 'img_' . time() . "." . $ext);
                $sponsor_path = 'uploads/images/sponsorsImages/img_' . time() . "." . $ext;
                 $sponsor->image = $sponsor_path;

            } 
        }
       
      
       $sponsor->save();
        session()->flash('message', 'تم تعديل البيانات بنجاح');
        return redirect('admin/Sponsors');
    }
      public function active($id)
    {
         $sponsor = Sponser::find($id);
        $sponsor->status = 0;
        $sponsor->save();

        session()->flash('message', 'تم الغاء تفعيل الراعي');
        return back();
    }

    public function unactive($id)
    {
       $sponsor = Sponser::find($id);
       $sponsor->status = 1;
       $sponsor->save();

        session()->flash('message', 'تم تفعيل الراعي');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $sponsor = Sponser::find($id);
         File::delete($sponsor->image);
        $sponsor->delete();
        session()->flash('message', 'تم حذف بيانات الراعي');
        return back();
    }
}
