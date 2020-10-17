<?php

namespace App\Http\Controllers;

use App\Group;
use App\Media;
use App\Team;
use App\User;
use App\Media_comments;
use App\Album_comments;
use App\Event_album;
use App\Event;
use App\Event_album_media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use function PHPSTORM_META\type;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
     public function createVidGallary()
    {
        return view('admin.media.addYvideoGallery');
    }


    public function storeVidGallary(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
             'description' => 'required',
            'media_link' => 
        array(
            'required',
            'regex:%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i'
        )  
           
        ], [
            'title.required' => 'من فضلك ادخل عنوان للميديا',
         'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_link.regex'=>'من فضلك ادخل لينك يوتيوب صحيح'     
        ]);
          
         if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->media_link, $match)) {
         $media_link = $match[1];

}

        Media::create([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'type' => 'فيديو',
            'status' => $request->status,
            'public' => 1,
            'media_type' => $request->media_type,
            'media_link' => $media_link,
            'added_by' => Auth::user()->id,
        ]);

        session()->flash('message', 'تمت اضافة الميديا الى الموقع بنجاح');
        return redirect('admin/gallary/');
    }


    public function editVidGallary($id)
    {
        $media = Media::find($id);
        return view('admin.media.editYvidGallery', compact('media'));
    }

        public function updateVidGallary(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
             'description' => 'required',
            'media_link' => 
        array(
            'required',
            'regex:%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i'
        )
       
        ], [
            'title.required' => 'من فضلك ادخل عنوان للميديا',
                     'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_link.regex'=>'من فضلك ادخل لينك يوتيوب صحيح'  
        ]);

         if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->media_link, $match)) {
         $media_link = $match[1];
     }

        $media = Media::find($id);

        $media->name = $request->name;
        $media->title = $request->title;
        $media->description = $request->description;
        $media->type = 'فيديو';
        $media->media_type = $request->media_type;
        $media->status = $request->status;
        $media->public = 1;
        $media->media_link =$media_link;

        $media->save();

        session()->flash('message', 'تم تعديل الميديا بنجاح');
        return redirect('admin/gallary');
    }
        public function createGroupVideo()
    {
        $groups = Group::all();
        return view('admin.media.addYvideoGroup', compact('groups'));
    }
        public function storeGroupVideo(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required',
            'title' => 'required',
             'description' => 'required',
            'media_link' => 
        array(
            'required',
            'regex:%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i'
        )
         
        ], [
            'group_id.required' => 'من فضلك قم بتحديد المجموعة المراد اضافة الميديا له',
            'title.required' => 'من فضلك ادخل عنوان للميديا',
                     'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_link.regex'=>'من فضلك ادخل لينك يوتيوب صحيح'          
        ]);

        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->media_link, $match)) {
         $media_link = $match[1];
     }

        Media::create([

            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'public' => 0,
            'group_id' => $request->group_id,
            'media_type' => 'جروب',
            'added_by' => Auth::user()->id,
             'type' => 'فيديو',
            'media_link' => $media_link,

        ]);

        session()->flash('message', 'تم اضافة الميديا للمجموعة');
        return redirect('admin/groups/show/media/' . $request->group_id);

    }
       public function editGroupVideo($id)
    {
        $media = Media::find($id);
        return view('admin.media.editYvideoGroup', compact('media'));
    }
       public function updateGroupVideo(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
             'description' => 'required',
            'media_link' => 
        array(
            'required',
            'regex:%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i'
        )
         
        ]);
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->media_link, $match)) {
         $media_link = $match[1];
     }

        $media = Media::find($id);

        $media->name = $request->name;
        $media->title = $request->title;
        $media->description = $request->description;
        $media->type = 'فيديو';
        $media->status = $request->status;
        $media->media_link =$media_link;

        $media->save();

        session()->flash('message', 'تم تعديل الميديا بنجاح');
        return redirect('admin/groups/show/media/' . $media->team_id);

    }
    public function createTeamVideo()
    {
        $teams = Team::all();
        return view('admin/media/addYvideoTeam', compact('teams'));
    }

    public function storeTeamVideo(Request $request)
    {
        $this->validate($request, [
            'team_id' => 'required',
            'title' => 'required',
             'description' => 'required',
            'media_link' => 
        array(
            'required',
            'regex:%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i'
        )
        ], [
            'team_id.required' => 'من فضلك قم بتحديد الفريق المراد اضافة الميديا له',
            'title.required' => 'من فضلك ادخل عنوان للميديا',
                     'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_link.regex'=>'من فضلك ادخل لينك يوتيوب صحيح'          
        ]);
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->media_link, $match)) {
         $media_link = $match[1];
}
        Media::create([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'type' => 'فيديو',
            'status' => $request->status,
            'public' => 0,
            'team_id' => $request->team_id,
            'media_type' => 'فريق',
            'media_link' => $media_link,
            'added_by' => Auth::user()->id,
        ]);

        session()->flash('message', 'تم اضافة الميديا للفريق');
        return redirect('admin/teams/show/media/' . $request->team_id);
    }
       public function editTeamVideo($id)
    {
        $media = Media::find($id);
        return view('admin.media.editYvideoTeam', compact('media'));
    }

    public function updateTeamVideo(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
             'description' => 'required',
            'media_link' => 
        array(
            'required',
            'regex:%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i'
        )
  
        ], [
            'title.required' => 'من فضلك ادخل عنوان للميديا',
                     'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_link.regex'=>'من فضلك ادخل لينك يوتيوب صحيح'         
        ]);
         if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->media_link, $match)) {
         $media_link = $match[1];
}
        $media = Media::find($id);

        $media->name = $request->name;
        $media->title = $request->title;
        $media->description = $request->description;
        $media->type = 'فيديو';
        $media->status = $request->status;
        $media->media_link = $media_link;

        $media->save();

        session()->flash('message', 'تم تعديل الميديا بنجاح');
        return redirect('admin/teams/show/media/' . $media->team_id);
    }
       public function create()
    {
        $users = User::whereIn('roles_id', [4, 5])->get();
        return view('admin.media.addYvideoUser', compact('users'));
    }

      public function store(Request $request)
    {
        //dd(Input::file('media_file')->guessExtension());
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required',
             'description' => 'required',
            'media_link' => 
        array(
            'required',
            'regex:%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i'
        )
        
        ], [
            'user_id.required' => 'من فضلك قم بتحديد الشخص المراد اضافة الميديا له',
            'title.required' => 'من فضلك ادخل عنوان للميديا',
                     'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_link.regex'=>'من فضلك ادخل لينك يوتيوب صحيح'           
        ]);
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->media_link, $match)) {
         $media_link = $match[1];
}
        Media::create([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'type' => 'فيديو',
            'status' => $request->status,
            'public' => 0,
            'user_id' => $request->user_id,
            'media_type' => 'عضو',
            'media_link' => $media_link,
            'added_by' => Auth::user()->id,
        ]);


        session()->flash('message', 'تمت اضافة الميديا الى العضو بنجاح');
        return redirect('admin/users/show/media/' . $request->user_id);

    }
   public function edit($id)
    {
        $media = Media::find($id);
        return view('admin.media.editYvideoUser', compact('media'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
             'description' => 'required',
            'media_link' => 
        array(
            'required',
            'regex:%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i'
        )
    
        ], [
            'title.required' => 'من فضلك ادخل عنوان للميديا',
                     'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_link.regex'=>'من فضلك ادخل لينك يوتيوب صحيح'          
        ]);
                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->media_link, $match)) {
         $media_link = $match[1];
}
        $media = Media::find($id);


        $media->name = $request->name;
        $media->title = $request->title;
        $media->description = $request->description;
        $media->type = 'فيديو';
        $media->status = $request->status;
        $media->media_link = $media_link;

        $media->save();

        session()->flash('message', 'تم تعديل الميديا بنجاح');
        return redirect('admin/users/show/media/' . $media->user_id);
    } 

     public function createeventsVideo()
    {
        $events = Event::where('status', '=', 1)->get();
        return view('admin.events.addYvideoEvent', compact('events'));
    }


    public function storeeventsVideo(Request $request)
    {
        $this->validate($request, [
            'event_id' => 'required',
            'album_id' => 'required',
            'title' => 'required',
             'description' => 'required',
            'media_link' => 
        array(
            'required',
            'regex:%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i'
        )
          
        ], [
            'event_id.required' => 'من فضلك اختر الفاعلية',
            'album_id.required' => 'من فضلك قم بتحديد البوم الفاعلية المراد اضافة الميديا له',
            'title.required' => 'من فضلك ادخل عنوان للميديا',
                     'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_link.regex'=>'من فضلك ادخل لينك يوتيوب صحيح'          
        ]);
         if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->media_link, $match)) {
         $media_link = $match[1];
}
        $media_id = Media::create([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'type' => 'فيديو',
            'status' => $request->status,
            'public' => 0,
            'media_type' => 'فاعليه',
            'media_link' => $media_link,
            'added_by' => Auth::user()->id,
        ])->id;

        Event_album_media::create([
            'event_album_id'=>$request->album_id,
            'media_id'=> $media_id,
        ]);

        session()->flash('message', 'تمت اضافة الميديا الى البوم الفاعلية بنجاح');
        return redirect('admin/event/album/show/media/' . $request->album_id);
    }

    public function editeventsVideo($id)
    {
        $media = Media::find($id);
        $event_id = $media->album[0]->event_id;
        $event = Event::find($event_id);
        $albums = Event::find($event_id)->albums;
        return view('admin.media.editYvideoEvent', compact('media','albums','event'));
    }


    public function updateeventsVideo(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
             'description' => 'required',
            'media_link' => 
        array(
            'required',
            'regex:%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i'
        )
           
        ], [
            'title.required' => 'من فضلك ادخل عنوان للميديا',
                     'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_link.regex'=>'من فضلك ادخل لينك يوتيوب صحيح'       
        ], [

        ]);
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->media_link, $match)) {
         $media_link = $match[1];
     }
       
        $media = Media::find($id);

        $media->name = $request->name;
        $media->title = $request->title;
        $media->description = $request->description;
        $media->type = 'فيديو';
        $media->status = $request->status;
        $media->media_link = $media_link;

        $media->save();

        Event_album_media::where('event_album_id','=',$media->album[0]->id)->delete();

        Event_album_media::create([
            'event_album_id'=>$request->album_id,
            'media_id'=> $media->id,
        ]);

        session()->flash('message', 'تم تعديل الميديا بنجاح');
        return redirect('admin/event/album/show/media/' . $request->album_id);
    }
    
    public function addMedia($id)
    {
        $users =  $users = User::whereIn('roles_id', [4, 5])->get();
        $user_id = $id;
        return view('admin.media.addYvideoUser', compact('users', 'user_id'));
    }

    public function addTeamMedia($id)
    {
        $teams = Team::all();
        $team_id = $id;
        return view('admin.media.addYvideoTeam', compact('teams', 'team_id'));
    }

    public function addGroupMedia($id)
    {
        $groups = Group::all();
        $group_id = $id;
        return view('admin.media.addYvideoGroup', compact('groups', 'group_id'));
    }
   
}
