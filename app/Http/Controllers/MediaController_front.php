<?php

namespace App\Http\Controllers;

use App\Media;
use App\User;
use App\Media_comments;
use foo\bar;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


class MediaController_front extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teams = $user->teams()->wherePivot('status', '=', 1)->get();
        $groups = $user->groups()->wherePivot('status', '=', 1)->get();

        $images_per_page = 6;
        $videos_per_page = 4;

        $images = $user->medias()->where('type', '=', 'صورة')->where('status', '=', 1)->paginate($images_per_page);
        $videos = $user->medias()->where('type', '=', 'فيديو')->where('status', '=', 1)->paginate($videos_per_page);

        $images_count = $user->medias->where('type', '=', 'صورة')->where('status', '=', 1)->count();
        $videos_count = $user->medias->where('type', '=', 'فيديو')->where('status', '=', 1)->count();


        $count_res = [
            'img' => ceil($images_count / $images_per_page),
            'vid' => ceil($videos_count / $videos_per_page),
        ];

        $max_length = array_search(max($count_res), $count_res);

        return view('frontEnd.media.media', compact('teams', 'groups', 'user', 'images', 'videos', 'max_length'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'belongTo' => 'required',
            'belongTo' => 'required',
            'group_id' => 'required_if:belongTo,==,group',
            'team_id' => 'required_if:belongTo,==,team',
            'optradio' => 'required',
            'media_file' => 'required_if:optradio,==,img|mimes:jpeg,jpg,png,gif,tif,tiff,asf,mp3,wma,ogg,wav,acc,WebM,mp4,ogg',
            'video_link' => 'required_if:optradio, ==,vid',

        ], [
            'title.required' => 'من فضلك ادخل عنوان للميديا',
            'description.required' => 'من فضلك ادخل وصف للميديا',
            'media_file.required' => 'من فضلك قم الصورة ',
            'media_file.mimes' => 'هذا النوع من الميديا غير مدعوم ',
            'belongTo.required' => ' من فضلك قم باختيار الفئة المراد اضافة الميديا لها',
            'group_id.required_if' => ' من فضلك قم باختيار المجموعة المراد اضافة الميديا لها',
            'team_id.required_if' => ' من فضلك قم باختيار الفريق المراد اضافة الميديا له',
            'optradio.required' => ' قم باختيار نوع الميديا المراد اضافتها سواء صورة او فيديو',
            'video_link' => ' قم بادخال لينك الفيديو',
        ], [

        ]);

        if ($request->optradio == 'img') {

            $imgExt = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff'];
            $audioExt = ['mp3', 'ogg', 'wav', 'acc', 'wma'];
            $videoExt = ['WebM', 'mp4', 'ogg'];

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

                } elseif (in_array($ext, $videoExt)) {

                    $file_type = 'فيديو';
                    $file->move(public_path('uploads/media/private/users/videos/'), 'video_' . time() . "." . $ext);
                    $media_path = 'uploads/media/private/users/videos/video_' . time() . "." . $ext;
                }
            }
        } elseif ($request->optradio == 'vid') {
            $media_path = $request->video_link;
            $media_name = NULL;
            $file_type = 'فيديو';
        }

        if ($request->belongTo == 'profile') {

            Media::create([
                'name' => $media_name,
                'title' => $request->title,
                'description' => $request->description,
                'type' => $file_type,
                'status' => 1,
                'public' => 2,
                'user_id' => Auth::user()->id,
                'media_type' => 'عضو',
                'media_link' => $media_path,
                'added_by' => Auth::user()->id,
            ]);


        } else if ($request->belongTo == 'group') {
            Media::create([
                'name' => $media_name,
                'title' => $request->title,
                'description' => $request->description,
                'type' => $file_type,
                'status' => 0,
                'public' => 2,
                'group_id' => $request->group_id,
                'media_type' => 'جروب',
                'media_link' => $media_path,
                'added_by' => Auth::user()->id,
            ]);

        } else if ($request->belongTo == 'team') {
            Media::create([
                'name' => $media_name,
                'title' => $request->title,
                'description' => $request->description,
                'type' => $file_type,
                'status' => 0,
                'public' => 2,
                'team_id' => $request->team_id,
                'media_type' => 'فريق',
                'media_link' => $media_path,
                'added_by' => Auth::user()->id,
            ]);
        }
    }


    public function showPublicMedia()
    {

        $images_per_page = 6;
        $videos_per_page = 4;
        $gallery_images = Media::where(['public' => 1, 'media_type' => 'عام', 'type' => 'صورة', 'status' => 1])->orderBy('id', 'desc')->paginate($images_per_page);
        $all_images_count = Media::where(['public' => 1, 'media_type' => 'عام', 'type' => 'صورة', 'status' => 1])->count();
        $gallery_videos = Media::where(['public' => 1, 'media_type' => 'عام', 'type' => 'فيديو', 'status' => 1])->orderBy('id', 'desc')->paginate($videos_per_page);
        $all_videoes_count = Media::where(['public' => 1, 'media_type' => 'عام', 'type' => 'فيديو', 'status' => 1])->count();

        $count_res = ['images' => ceil($all_images_count / $images_per_page), 'videos' => ceil($all_videoes_count / $videos_per_page)];
        //$count_res=['images' => 3,'videos' => 9];
        $max_length = array_search(max($count_res), $count_res);

        return view('frontEnd.media.gallary', compact('gallery_images', 'gallery_videos', 'max_length'));
    }

    public function showAllMedia()
    {

//        $all_gallery = User::find(Auth::user()->id)->gallaryPag();

        $all_gallery = Media::all();
        $all_gallery = Media::paginate(12);
        foreach ($all_gallery as $gallery) {
            if ($gallery->type == 'صورة') {
                $gallery_images[] = $gallery;
            } else if ($gallery->type == 'فيديو') {

                $gallery_videos[] = $gallery;
            } else {
                $gallery_audios[] = $gallery;
            }
        }


        return view('frontEnd.media.AllGallery', compact('gallery_images', 'gallery_audios', 'gallery_videos', 'all_gallery'));
    }

    public function showPublicMediaDetails($id)
    {
        $media = Media::find($id);


        return view('frontEnd.media.GalleryDetails', compact('media'));

    }

    public function showPublicVideoDetails($id)
    {
        $media = Media::find($id);
        return view('frontEnd.media.VideoDetails', compact('media'));
    }

    public function add_comment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',

        ], [
            'comment.required' => 'من فضلك ادخل  التعليق',

        ], [

        ]);

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }
        if ($request->has('parent')) {
            $parent = $request->parent;
        } else {
            $parent = 0;
        }
        Media_comments::create([
            'user_id' => auth()->user()->id,
            'media_id' => $request->media_id,
            'comment' => $request->comment,
            'status' => 1,
            'parent' => $parent,
            'published_at' => date('y-m-d H:i:s')

        ]);

        session()->flash('message', 'تم اضافة التعليق');
        return back();
    }

    public function addComment(Request $request, $media_id)
    {
        if ($request->comment == '') {
            $url = URL::to('events/' . $media_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة التعليق اولا');
        }

        Media_comments::create([
            'media_id' => $media_id,
            'comment' => $request->comment,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة تعليقك بنجاح');
        $url = URL::to('gallary-details/' . $media_id) . '#scroll';
        return Redirect::to($url);
    }

    public function editComment(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required',
        ], [
            'comment.required' => 'من فضلك اضف تعليقك',
        ], []);

        $comment = Media_comments::find($request->commentID);

        $comment->comment = $request->comment;
        $comment->save();

    }

    public function addReply(Request $request, $media_id, $comment_id)
    {

        if ($request->reply == '') {
            $url = URL::to('gallary-details/' . $media_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة الرد اولا');
        }

        Media_comments::create([
            'media_id' => $media_id,
            'comment' => $request->reply,
            'parent' => $comment_id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة الرد بنجاح');
        $url = URL::to('gallary-details/' . $media_id) . '#scroll';
        return Redirect::to($url);
    }

    public function deleteComment(Request $request, $media_id, $comment_id)
    {
        $comment = Media_comments::find($comment_id);

        if ($comment->parent == 0) {
            Media_comments::where('parent', '=', $comment->id)->delete();
        }
        $comment->delete();

        session()->flash('message', 'تم الحذف بنجاح !');
        $url = URL::to('gallary-details/' . $media_id) . '#scroll';
        return Redirect::to($url);
    }

    public function add_comment2(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',

        ], [
            'comment.required' => 'من فضلك ادخل  التعليق',

        ], [

        ]);

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }
        if ($request->has('parent')) {
            $parent = $request->parent;
        } else {
            $parent = 0;
        }
        Media_comments::create([
            'user_id' => auth()->user()->id,
            'media_id' => $request->media_id,
            'comment' => $request->comment,
            'status' => 1,
            'parent' => $parent,
            'published_at' => date('y-m-d H:i:s')

        ]);

        session()->flash('message', 'تم اضافة التعليق');
        return back();
    }

    public function addComment2(Request $request, $media_id)
    {
        if ($request->comment == '') {
            $url = URL::to('events/' . $media_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة التعليق اولا');
        }

        Media_comments::create([
            'media_id' => $media_id,
            'comment' => $request->comment,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة تعليقك بنجاح');
        $url = URL::to('video-details/' . $media_id) . '#scroll';
        return Redirect::to($url);
    }

    public function editComment2(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required',
        ], [
            'comment.required' => 'من فضلك اضف تعليقك',
        ], []);

        $comment = Media_comments::find($request->commentID);

        $comment->comment = $request->comment;
        $comment->save();

    }

    public function addReply2(Request $request, $media_id, $comment_id)
    {

        if ($request->reply == '') {
            $url = URL::to('video-details/' . $media_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة الرد اولا');
        }

        Media_comments::create([
            'media_id' => $media_id,
            'comment' => $request->reply,
            'parent' => $comment_id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة الرد بنجاح');
        $url = URL::to('gallary-details/' . $media_id) . '#scroll';
        return Redirect::to($url);
    }

    public function deleteComment2(Request $request, $media_id, $comment_id)
    {
        $comment = Media_comments::find($comment_id);

        if ($comment->parent == 0) {
            Media_comments::where('parent', '=', $comment->id)->delete();
        }
        $comment->delete();

        session()->flash('message', 'تم الحذف بنجاح !');
        $url = URL::to('video-details/' . $media_id) . '#scroll';
        return Redirect::to($url);
    }
}
