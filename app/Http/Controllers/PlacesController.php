<?php

namespace App\Http\Controllers;

use App\Place;
use App\Event;
use App\Match;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Arabicdatetime;
class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::all();
        return view('admin.places.placesManagment', compact('places'));
    }
      public function showPublicPlaces()
    {
        // $vb=\Arabicdatetime::getDays();
        // dd($vb);

        // dd(Arabicdatetime::getArabicMonths());
        /*dd(Arabicdatetime::date(1552634081 , 0 , 'd / M / Y '  ,'indian'));
      */
    $events_per_page = 4;
    $matches_per_page = 4;


    $events = Place::where(['status' => 1])->whereHas('events')->orderby('id','DESC')->paginate($events_per_page);
    $events_count = Place::where(['status' => 1])->whereHas('events')->count();

    $matches = Place::where(['status' => 1])->whereHas('matches')->orderby('id','DESC')->paginate($matches_per_page);
    $matches_count = Place::where(['status' => 1])->whereHas('matches')->count();

       $count_res = ['events' => ceil($events_count / $events_per_page), 'matches' => ceil($matches_count / $matches_per_page)];
        //$count_res=['images' => 3,'videos' => 9];
        $max_length = array_search(max($count_res), $count_res);


        return view('frontEnd.places', compact('events','matches','max_length'));
    }

    /**
     * Show the form for creating a place resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.places.createPlace');
    }

    /**
     * Store a placely created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'placeimg' => 'required',
        ], [
            'name.required' => 'من فضلك ادخل  المكان',
            'address.required' => 'من فضلك ادخل العنوان',

            'placeimg.required' => 'من فضلك ادخل صوره المكان',
           
        ], [

        ]);
        $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];

        

        $saved=[
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => Auth::user()->id,
            'status' => $request->status,
          
           // 'image' => $img_url,
        ];

        if (request()->hasfile('placeimg')) {

            $file = request()->file('placeimg');
            $places_name = $request->placeimg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/placesImages/'), 'img_' . time() . "." . $ext);
                $places_path = 'uploads/images/placesImages/img_' . time() . "." . $ext;
                  $img_url = $places_path;
                  $saved['image']=$img_url;

            } 
        }

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

        Place::create($saved);


        session()->flash('message', 'تم اضافة المكان');
        return redirect('admin/places');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Place $places
     * @return \Illuminate\Http\Response
     */
    public function show(Place $places)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Place $places
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::find($id);
        return view('admin.places.editPlace', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Place $places
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'name' => 'required',
            'address' => 'required',
            //'placeimg' => 'required',
        ], [
            'name.required' => 'من فضلك ادخل  المكان',
            'address.required' => 'من فضلك ادخل العنوان',

            //'placeimg.required' => 'من فضلك ادخل صوره المكان',
           
        ], [

        ]);

        $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];
      

        if ($request->hasFile('placeimg')) {
             
            $fileExtention = strtolower($request->placeimg->getClientOriginalExtension());
            if (!in_array($fileExtention, $imgExt)) {
                $validationErrors[] = 'هذة ليست بصورة او انك قمت باختيار صورة غير مدعومة';
            }
        }

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

        $place = Place::find($id);
        $place->name = $request->name;
        $place->address = $request->address;
        $place->status = $request->status;



        if (request()->hasfile('placeimg')) {
             File::delete($place->image);
            $file = request()->file('placeimg');
            $places_name = $request->placeimg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/placesImages/'), 'img_' . time() . "." . $ext);
                $places_path = 'uploads/images/placesImages/img_' . time() . "." . $ext;
                 $place->image = $places_path;

            } 
        }
       

        $place->save();
        session()->flash('message', 'تم تعديل البيانات بنجاح');
        return redirect('admin/places');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Place $places
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $places=Place::find($id);
         File::delete($places->image);
        $places->delete();
        session()->flash('message', 'تم حذف بيانات المكان بنجاح');
        return back();
    }

    public function active($id)
    {
        $place = Place::find($id);
        $place->status = 0;
        $place->save();

        session()->flash('message', 'تم الغاء تفعيل المان');
        return back();
    }

    public function unactive($id)
    {
        $place = Place::find($id);
        $place->status = 1;
        $place->save();


        session()->flash('message', 'تم تفعيل المان بنجاح');
        return back();
    }
}
