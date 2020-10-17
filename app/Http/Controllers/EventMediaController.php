<?php

namespace App\Http\Controllers;

use App\Event;
use App\Event_album;
use App\Event_album_media;
use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class EventMediaController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        $events = Event::where('status', '=', 1)->get();
        return view('admin.events.createAlbumMedia', compact('events'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'event_id' => 'required',
            'album_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'media_file' => 'required|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc,WebM,mp4,ogg',
        ], [
            'event_id.required' => 'من فضلك اختر الفاعلية',
            'album_id.required' => 'من فضلك قم بتحديد البوم الفاعلية المراد اضافة الميديا له',
            'title.required' => 'من فضلك ادخل عنوان للميديا',
            'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_file.required' => 'من فضلك قم باختيار الميديا ',
            'media_file.mimes' => 'هذا النوع من الميديا غير مدعوم ',
        ], [

        ]);
        $imgExt = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff'];
        $audioExt = ['mp3', 'ogg', 'wav', 'acc', 'wma'];
        $videoExt = ['WebM', 'mp4', 'ogg'];

        if (request()->hasfile('media_file')) {

            $file = request()->file('media_file');
            $media_name = $request->media_file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/media/private/events/images/'), 'img_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/events/images/img_' . time() . "." . $ext;

            } elseif (in_array($ext, $audioExt)) {

                $file_type = 'ملف صوت';
                $file->move(public_path('uploads/media/private/events/audios/'), 'audio_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/events/audios/audio_' . time() . "." . $ext;

            } elseif (in_array($ext, $videoExt)) {

                $file_type = 'فيديو';
                $file->move(public_path('uploads/media/private/events/videos/'), 'video_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/events/videos/video_' . time() . "." . $ext;
            }
        }

        $media_id = Media::create([
            'name' => $media_name,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $file_type,
            'status' => $request->status,
            'public' => 0,
            'media_type' => 'فاعليه',
            'media_link' => $media_path,
            'added_by' => Auth::user()->id,
        ])->id;

        Event_album_media::create([
            'event_album_id'=>$request->album_id,
            'media_id'=> $media_id,
        ]);

        session()->flash('message', 'تمت اضافة الميديا الى البوم الفاعلية بنجاح');
        return redirect('admin/event/album/show/media/' . $request->album_id);
    }

    public function edit($id)
    {
        $media = Media::find($id);
        $event_id = $media->album[0]->event_id;
        $event = Event::find($event_id);
        $albums = Event::find($event_id)->albums;
        return view('admin.media.editAlbumMedia', compact('media','albums','event'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'media_file' => 'sometimes|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc,WebM,mp4,ogg',
        ], [
            'title.required' => 'من فضلك ادخل عنوان للميديا',
            'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_file.required' => 'من فضلك قم باختيار الميديا ',
            'media_file.mimes' => 'هذا النوع من الميديا غير مدعوم ',
        ], [

        ]);

        $media = Media::find($id);

        $imgExt = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff'];
        $audioExt = ['mp3', 'ogg', 'wav', 'acc', 'wma'];
        $videoExt = ['WebM', 'mp4', 'ogg'];

        if (request()->hasfile('media_file')) {

            File::delete($media->media_link);
            $file = request()->file('media_file');
            $media_name = $request->media_file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/media/private/events/images/'), 'img_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/events/images/img_' . time() . "." . $ext;

            } elseif (in_array($ext, $audioExt)) {

                $file_type = 'ملف صوت';
                $file->move(public_path('uploads/media/private/events/audios/'), 'audio_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/events/audios/audio_' . time() . "." . $ext;

            } elseif (in_array($ext, $videoExt)) {

                $file_type = 'فيديو';
                $file->move(public_path('uploads/media/private/events/videos/'), 'video_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/events/videos/video_' . time() . "." . $ext;
            }
        } else {

            $media_name = $media->name;
            $file_type = $media->type;
            $media_path = $media->media_link;
        }

        $media->name = $media_name;
        $media->title = $request->title;
        $media->description = $request->description;
        $media->type = $file_type;
        $media->status = $request->status;
        $media->media_link = $media_path;

        $media->save();

        Event_album_media::where('event_album_id','=',$media->album[0]->id)->delete();

        Event_album_media::create([
            'event_album_id'=>$request->album_id,
            'media_id'=> $media->id,
        ]);

        session()->flash('message', 'تم تعديل الميديا بنجاح');
        return redirect('admin/event/album/show/media/' . $request->album_id);
    }


    public function destroy($id)
    {
        //
    }

    public function showMedia($id)
    {
        $event = Event_album::find($id);
        $albumName = $event->name;
        $medias = $event->medias;
        return view('admin.media.albumMedia',compact('medias','albumName'));
    }

    ////////////////// Event albums ///////////////


    public function showAlbums()
    {

        $albums = Event_album::all();
        return view('admin.media.albumsManagement', compact('albums'));
    }

    public function createAlbum()
    {

        $events = Event::where('status', '=', 1)->get();
        return view('admin.media.createAlbum', compact('events'));
    }

    public function createAlbumforEvent($id)
    {
        $event_id = Event::find($id)->id;
        $events = Event::where('status', '=', 1)->get();
        return view('admin.media.createAlbum', compact('events','event_id'));
    }

    public function storeAlbum(Request $request)
    {

        $this->validate($request, [
            'event_id' => 'required',
            'name' => 'required',
        ], [
            'event_id.required' => 'من فضلك قم بتحديد الغفاعلية المراد اضافة البوم الميديا لها',
            'name.required' => 'من فضلك ادخل اسم الالبوم',

        ], []);

        Event_album::create([
            'name' => $request->name,
            'event_id' => $request->event_id,
            'status' => $request->status,
        ]);

        session()->flash('message', 'تم اضافة الالبوم بنجاح');
        return redirect('admin/event/album/');
    }

    public function editAlbum($id)
    {
        $album = Event_album::find($id);
        $events = Event::where('status', '=', 1)->get();
        return view('admin.media.editAlbum', compact('events', 'album'));
    }

    public function updateAlbum(Request $request, $id)
    {

        $this->validate($request, [
            'event_id' => 'required',
            'name' => 'required',
        ], [
            'event_id.required' => 'من فضلك قم بتحديد الغفاعلية المراد اضافة البوم الميديا لها',
            'name.required' => 'من فضلك ادخل اسم الالبوم',

        ], []);

        $album = Event_album::find($id);

        $album->name = $request->name;
        $album->event_id = $request->event_id;
        $album->status = $request->status;

        $album->save();

        session()->flash('message', 'تم تعديل بيانات الالبوم بنجاح');
        return redirect('admin/event/album/');
    }

    public function destroyAlbum($id)
    {
        $event_album = Event_album::find($id);
        $event_album->delete();
        session()->flash('message', 'تم حذف بيانات الالبوم بنجاح');
        return back();
    }

    public function active($id)
    {
        $event_album = Event_album::find($id);
        $event_album->status = 0;
        $event_album->save();

        session()->flash('message', 'تم الغاء تفعيل الالبوم');
        return back();
    }

    public function unactive($id)
    {
        $event_album = Event_album::find($id);
        $event_album->status = 1;
        $event_album->save();

        session()->flash('message', 'تم تفعيل الالبوم بنجاح');
        return back();
    }


}
