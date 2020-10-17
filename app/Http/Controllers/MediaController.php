<?php

namespace App\Http\Controllers;

use App\Group;
use App\Media;
use App\Team;
use App\User;
use App\Media_comments;
use App\Album_comments;
use App\Event_album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use function PHPSTORM_META\type;

class MediaController extends Controller
{

    public function index()
    {
        $medias = Media::where('user_id', '<>', NULL)->get();
        return view('admin.media.userMediaManagement', compact('medias'));
    }

    public function showTeamMedia()
    {
        $medias = Media::where('team_id', '<>', NULL)->get();
        return view('admin.media.teamMediaManagement', compact('medias'));
    }

    public function showGroupMedia()
    {
        $medias = Media::where('group_id', '<>', NULL)->get();
        return view('admin.media.groupMediaManagement', compact('medias'));
    }


    public function create()
    {
        $users = User::whereIn('roles_id', [4, 5])->get();
        return view('admin.media.createMedia', compact('users'));
    }

    public function createTeamMedia()
    {
        $teams = Team::all();
        return view('admin/media/createTeamMedia', compact('teams'));
    }

    public function createGroupMedia()
    {
        $groups = Group::all();
        return view('admin/media/createGroupMedia', compact('groups'));
    }

    public function store(Request $request)
    {
        //dd(Input::file('media_file')->guessExtension());
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'media_file' => 'required|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc',
        ], [
            'user_id.required' => 'من فضلك قم بتحديد الشخص المراد اضافة الميديا له',
            'title.required' => 'من فضلك ادخل عنوان للميديا',
            'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_file.required' => 'من فضلك قم باختيار الميديا ',
            'media_file.mimes' => 'هذا النوع من الميديا غير مدعوم ',
        ], [

        ]);
        $imgExt = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff'];
        $audioExt = ['mp3', 'ogg', 'wav', 'acc', 'wma'];
      

        if (request()->hasfile('media_file')) {

            $file = request()->file('media_file');
            $media_name = $request->media_file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/media/private/users/images/'), 'img_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/users/images/img_' . time() . "." . $ext;

            } elseif (in_array($ext, $audioExt)) {

                $file_type = 'ملف صوت';
                $file->move(public_path('uploads/media/private/users/audios/'), 'audio_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/users/audios/audio_' . time() . "." . $ext;

            }
        }

        Media::create([
            'name' => $media_name,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $file_type,
            'status' => $request->status,
            'public' => 0,
            'user_id' => $request->user_id,
            'media_type' => 'عضو',
            'media_link' => $media_path,
            'added_by' => Auth::user()->id,
        ]);


        session()->flash('message', 'تمت اضافة الميديا الى العضو بنجاح');
        return redirect('admin/users/show/media/' . $request->user_id);

    }

    public function edit($id)
    {
        $media = Media::find($id);
        return view('admin.media.editMedia', compact('media'));
    }

    public function editGallary($id)
    {
        $media = Media::find($id);
        return view('admin.media.editGallary', compact('media'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'media_file' => 'sometimes|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc',
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
      

        if (request()->hasfile('media_file')) {

            File::delete($media->media_link);
            $file = request()->file('media_file');
            $media_name = $request->media_file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/media/private/users/images/'), 'img_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/users/images/img_' . time() . "." . $ext;

            } elseif (in_array($ext, $audioExt)) {

                $file_type = 'ملف صوت';
                $file->move(public_path('uploads/media/private/users/audios/'), 'audio_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/users/audios/audio_' . time() . "." . $ext;

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

        session()->flash('message', 'تم تعديل الميديا بنجاح');
        return redirect('admin/users/show/media/' . $media->user_id);
    }


    public function updateGallary(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'media_type' => 'required',
            'media_file' => 'sometimes|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc',
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
        

        if (request()->hasfile('media_file')) {

            File::delete($media->media_link);
            $file = request()->file('media_file');
            $media_name = $request->media_file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/media/public/images/'), 'img_' . time() . "." . $ext);
                $media_path = 'uploads/media/public/images/img_' . time() . "." . $ext;

            } elseif (in_array($ext, $audioExt)) {

                $file_type = 'ملف صوت';
                $file->move(public_path('uploads/media/public/audios/'), 'audio_' . time() . "." . $ext);
                $media_path = 'uploads/media/public/audios/audio_' . time() . "." . $ext;

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
        $media->media_type = $request->media_type;
        $media->status = $request->status;
        $media->public = 1;
        $media->media_link = $media_path;

        $media->save();

        session()->flash('message', 'تم تعديل الميديا بنجاح');
        return redirect('admin/gallary');
    }


    public function destroy($id)
    {
        $media = Media::find($id);
        File::delete($media->media_link);
        $media->delete();
        session()->flash('message', 'تم حذف بيانات الميديا بنجاح');
        return back();
    }

    public function active($id)
    {
        $media = Media::find($id);
        $media->status = 0;
        $media->save();

        session()->flash('message', 'تم الغاء تفعيل الميديا');
        return back();
    }

    public function unactive($id)
    {
        $media = Media::find($id);
        $media->status = 1;
        $media->save();

        session()->flash('message', 'تم تفعيل الميديا بنجاح');
        return back();
    }

    public function addMedia($id)
    {
        $users =  $users = User::whereIn('roles_id', [4, 5])->get();
        $user_id = $id;
        return view('admin.media.createMedia', compact('users', 'user_id'));
    }

    public function addTeamMedia($id)
    {
        $teams = Team::all();
        $team_id = $id;
        return view('admin.media.createTeamMedia', compact('teams', 'team_id'));
    }

    public function addGroupMedia($id)
    {
        $groups = Group::all();
        $group_id = $id;
        return view('admin.media.createGroupMedia', compact('groups', 'group_id'));
    }

    public function storeTeamMedia(Request $request)
    {
        $this->validate($request, [
            'team_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'media_file' => 'required|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc',
        ], [
            'team_id.required' => 'من فضلك قم بتحديد الفريق المراد اضافة الميديا له',
            'title.required' => 'من فضلك ادخل عنوان للميديا',
            'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_file.required' => 'من فضلك قم باختيار الميديا ',
            'media_file.mimes' => 'هذا النوع من الميديا غير مدعوم ',
        ], [

        ]);

        $imgExt = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff'];
        $audioExt = ['mp3', 'ogg', 'wav', 'acc', 'wma'];
       
        if (request()->hasfile('media_file')) {

            $file = request()->file('media_file');
            $media_name = $request->media_file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/media/private/teams/images/'), 'img_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/teams/images/img_' . time() . "." . $ext;

            } elseif (in_array($ext, $audioExt)) {

                $file_type = 'ملف صوت';
                $file->move(public_path('uploads/media/private/teams/audios/'), 'audio_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/teams/audios/audio_' . time() . "." . $ext;

            } 
        }

        Media::create([
            'name' => $media_name,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $file_type,
            'status' => $request->status,
            'public' => 0,
            'team_id' => $request->team_id,
            'media_type' => 'فريق',
            'media_link' => $media_path,
            'added_by' => Auth::user()->id,
        ]);

        session()->flash('message', 'تم اضافة الميديا للفريق');
        return redirect('admin/teams/show/media/' . $request->team_id);
    }

    public function storeGroupMedia(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'media_file' => 'required|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc',
        ], [
            'group_id.required' => 'من فضلك قم بتحديد المجموعة المراد اضافة الميديا له',
            'title.required' => 'من فضلك ادخل عنوان للميديا',
            'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_file.required' => 'من فضلك قم باختيار الميديا ',
            'media_file.mimes' => 'هذا النوع من الميديا غير مدعوم ',
        ], [

        ]);

        $imgExt = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff'];
        $audioExt = ['mp3', 'ogg', 'wav', 'acc', 'wma'];
       

        if (request()->hasfile('media_file')) {

            $file = request()->file('media_file');
            $media_name = $request->media_file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/media/private/groups/images/'), 'img_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/groups/images/img_' . time() . "." . $ext;

            } elseif (in_array($ext, $audioExt)) {

                $file_type = 'ملف صوت';
                $file->move(public_path('uploads/media/private/groups/audios/'), 'audio_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/groups/audios/audio_' . time() . "." . $ext;

            } 
        }

        Media::create([
            'name' => $media_name,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $file_type,
            'status' => $request->status,
            'public' => 0,
            'group_id' => $request->group_id,
            'media_type' => 'جروب',
            'media_link' => $media_path,
            'added_by' => Auth::user()->id,
        ]);

        session()->flash('message', 'تم اضافة الميديا للمجموعة');
        return redirect('admin/groups/show/media/' . $request->group_id);

    }

    public function editTeamMedia($id)
    {
        $media = Media::find($id);
        return view('admin.media.editTeamMedia', compact('media'));
    }

    public function editGroupMedia($id)
    {
        $media = Media::find($id);
        return view('admin.media.editGroupMedia', compact('media'));
    }

    public function updateTeamMedia(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'media_file' => 'sometimes|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc',
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
       

        if (request()->hasfile('media_file')) {

            File::delete($media->media_link);
            $file = request()->file('media_file');
            $media_name = $request->media_file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/media/private/teams/images/'), 'img_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/teams/images/img_' . time() . "." . $ext;

            } elseif (in_array($ext, $audioExt)) {

                $file_type = 'ملف صوت';
                $file->move(public_path('uploads/media/private/teams/audios/'), 'audio_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/teams/audios/audio_' . time() . "." . $ext;

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

        session()->flash('message', 'تم تعديل الميديا بنجاح');
        return redirect('admin/teams/show/media/' . $media->team_id);
    }

    public function updateGroupMedia(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'media_file' => 'sometimes|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc',
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
      

        if (request()->hasfile('media_file')) {

            File::delete($media->media_link);
            $file = request()->file('media_file');
            $media_name = $request->media_file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/media/private/groups/images/'), 'img_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/groups/images/img_' . time() . "." . $ext;

            } elseif (in_array($ext, $audioExt)) {

                $file_type = 'ملف صوت';
                $file->move(public_path('uploads/media/private/groups/audios/'), 'audio_' . time() . "." . $ext);
                $media_path = 'uploads/media/private/groups/audios/audio_' . time() . "." . $ext;

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

        session()->flash('message', 'تم تعديل الميديا بنجاح');
        return redirect('admin/groups/show/media/' . $media->team_id);

    }

    public function showGallary()
    {
        $medias = Media::all()->where('public', '=', 1);
        return view('admin.media.gallaryManagment', compact('medias'));
    }

    public function createGallary()
    {
        return view('admin.media.createGallary');
    }

    public function storeGallary(Request $request)
    {
//        dd(Input::file('media_file')->guessExtension());
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'media_type' => 'required',
            'media_file' => 'required|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc',
        ], [
            'title.required' => 'من فضلك ادخل عنوان للميديا',
            'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_file.required' => 'من فضلك قم باختيار الميديا ',
            'media_file.mimes' => 'هذا النوع من الميديا غير مدعوم ',
            'media_type.required' => 'من فضلك حدد تصنيف الميديا',
        ], [

        ]);
        $imgExt = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff'];
        $audioExt = ['mp3', 'ogg', 'wav', 'acc', 'wma'];
      

        if (request()->hasfile('media_file')) {

            $file = request()->file('media_file');
            $media_name = $request->media_file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/media/public/images/'), 'img_' . time() . "." . $ext);
                $media_path = 'uploads/media/public/images/img_' . time() . "." . $ext;

            } elseif (in_array($ext, $audioExt)) {

                $file_type = 'ملف صوت';
                $file->move(public_path('uploads/media/public/audios/'), 'audio_' . time() . "." . $ext);
                $media_path = 'uploads/media/public/audios/audio_' . time() . "." . $ext;

            } 
        }

        Media::create([
            'name' => $media_name,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $file_type,
            'status' => $request->status,
            'public' => 1,
            'media_type' => $request->media_type,
            'media_link' => $media_path,
            'added_by' => Auth::user()->id,
        ]);

        session()->flash('message', 'تمت اضافة الميديا الى الموقع بنجاح');
        return redirect('admin/gallary/');
    }
      public function deleteMediaComment($id)
    {
        Media_comments::find($id)->delete();
        Media_comments::where('parent', '=', $id)->delete();
        session()->flash('message', 'تم حذف التعليق بنجاح');
        return back();
    }

    public function deleteMediaCommentReply($id)
    {
        Media_comments::find($id)->delete();
        session()->flash('message', 'تم حذف الرد بنجاح');
        return back();
    }



    public function activeComment($id)
    {
        $media = Media_comments::find($id);
        $media->status = 0;
        $media->save();

        session()->flash('message', 'تم حظر التعليق');
        return back();
    }

    public function unactiveComment($id)
    {
        $media = Media_comments::find($id);
        $media->status = 1;
        $media->save();

        session()->flash('message', 'تم تفعيل التعليق بنجاح');
        return back();
    }

    public function showMediaComments($id)
    {
        $media = Media::find($id);
        $comments = Media::find($id)->comments->where('parent', '=', 0);
        return view('admin/media/mediaCommentsManagment', compact('media', 'comments'));

    }

    public function showCommentReplies($id)
    {
        $replies = Media_comments::find($id)->replies;
        $comment = Media_comments::find($id);
        return view('admin/media/mediaCommentReplies', compact('replies', 'comment'));

    }

    public function storeMediaReply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ], ['reply.required' => 'قم بكتابة الرد اولا',], []);

        $media_id = Media_comments::find($id)->media->id;

        Media_comments::create([
            'media_id' => $media_id,
            'comment' => $request->reply,
            'parent' => $id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        return back();

    }
       public function storeMediacomment(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ], ['reply.required' => 'قم بكتابة الرد اولا',], []);

        // $new_id = News_comment::find($id)->news->id;

        Media_comments::create([
            'media_id' => $id,
            'comment' => $request->reply,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        return back();


    }
 


}

