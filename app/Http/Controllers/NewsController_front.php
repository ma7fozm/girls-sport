<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use App\News;
use App\News_comment;
use App\Place;
use App\Match;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class NewsController_front extends Controller
{
    public function index()
    {
        $news = News::where('status', '=', 1)->where('news_type', '=', 'عام')->orderBy('id', 'desc')->paginate(10);

        $events = Event::where('status', '=', 1)->orderBy('id', 'desc')->take(5)->get()->toArray();
        $places = Place::where('status', '=', 1)->orderBy('id', 'desc')->take(5)->get()->toArray();

        $played_matchs = Match::where('status', '=', 1)->where('result', '!=', NULL)->get();
        $comming_matchs =Match::where('status', '=', 1)->where('result', '=', NULL)->get();

        if (!empty($events)) {
            $event = $events[array_rand($events)];
        }

        if (!empty($places)) {
            $place = $places[array_rand($places)];
        }

        return view('frontEnd.news.news', compact('news', 'event', 'place', 'events', 'places', 'played_matchs', 'comming_matchs'));
    }

    public function showPublichealth()
    {

        $health = News::where('news_type', '=', 'صحه')->orderBy('id', 'desc')->paginate(6);
        return view('frontEnd.news.health')->with('health', $health);
    }

    public function showPublichealthDetails($id)
    {
        $health = News::find($id);
        return view('frontEnd.news.healthdetails', compact('health'));

    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.news.createNew', compact('categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'intro' => 'required',
            'newContent' => 'required',
            'newImg' => 'required',
            'category_id' => 'required',
        ], [
            'title.required' => 'من فضلك ادخل  عنوان للخبر',
            'intro.required' => 'من فضلك ادخل مقدمة للخبر',
            'newContent.required' => 'من فضلك محتوى الخبر',
            'newImg.required' => 'من فضلك قم باختيار صورة للخبر',
            'category_id.required' => ' من فضلك قم باختيار الفئة المنتمى اليها هذا الخبر',
        ], [

        ]);
        $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];
        if ($request->category_id == 0) {
            $validationErrors[] = 'لابد من تحديد الفئة التى ينتمى اليها هذا الخبر';
        }

        if ($request->hasFile('newImg')) {
            $fileExtention = strtolower($request->newImg->getClientOriginalExtension());
            if (!in_array($fileExtention, $imgExt)) {
                $validationErrors[] = 'هذة ليست بصورة او انك قمت باختيار صورة غير مدعومة';
            } else {
                $filename = time() . $request->newImg->getClientOriginalName();
                $request->newImg->storeAs('public/upload/newsImages', $filename);
                $img_url = asset('storage/upload/newsImages/' . $filename);
            }
        }

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

        News::create([
            'title' => $request->title,
            'intro' => $request->intro,
            'status' => 1,
            'content' => $request->newContent,
            'category_id' => $request->category_id,
            'image' => $filename,
        ]);


        session()->flash('message', 'تم اضافة الخبر');
        return redirect('admin/news');
    }

    public function show($id)
    {
        $new = News::find($id);
        return view('frontEnd.news.newsDetails', compact('new'));
    }


    public function edit($id)
    {
        $new = News::find($id);
        $categories = Category::all();
        return view('admin.news.editNew', compact('new', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'intro' => 'required',
            'newContent' => 'required',
            'category_id' => 'required',
        ], [
            'title.required' => 'من فضلك ادخل  عنوان للخبر',
            'intro.required' => 'من فضلك ادخل مقدمة للخبر',
            'newContent.required' => 'من فضلك محتوى الخبر',
            'category_id.required' => ' من فضلك قم باختيار الفئة المنتمى اليها هذا الخبر',
        ], [

        ]);
        $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];
        if ($request->category_id == 0) {
            $validationErrors[] = 'لابد من تحديد الفئة التى ينتمى اليها هذا الخبر';
        }

        if ($request->hasFile('newImg')) {
            $fileExtention = strtolower($request->newImg->getClientOriginalExtension());
            if (!in_array($fileExtention, $imgExt)) {
                $validationErrors[] = 'هذة ليست بصورة او انك قمت باختيار صورة غير مدعومة';
            }
        }

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

        $new = News::find($id);
        $new->title = $request->title;
        $new->intro = $request->intro;
        $new->content = $request->newContent;
        $new->category_id = $request->category_id;

        if ($request->hasFile('newImg')) {
            $filename = $request->newImg->getClientOriginalName();
            $request->newImg->storeAs('public/upload/images', $filename);
            $new->image = $filename;
        } else {
            $new->image = $new->image;
        }

        $new->save();
        session()->flash('message', 'تم تعديل البيانات بنجاح');
        return redirect('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::find($id)->delete();
        session()->flash('message', 'تم حذف بيانات الجروب بنجاح');
        return back();
    }

    public function active($id)
    {
        $new = News::find($id);
        $new->status = 0;
        $new->save();

        session()->flash('message', 'تم الغاء تفعيل الجروب');
        return back();
    }

    public function unactive($id)
    {
        $new = News::find($id);
        $new->status = 1;
        $new->save();

        session()->flash('message', 'تم تفعيل الجروب بنجاح');
        return back();
    }

    public function showNewDetails($id)
    {
        $new = News::find($id);
//        $comments = News_comment::where(['new_id' => $new->id, 'parent' => 0, 'status' => 1])->get();
//        $i = 0;
//        foreach ($comments as $comm) {
//            $sub_comments[$i] = $comm;
//            $sub_comments[$i]['sub_comment'] = News_comment::where(['new_id' => $new->id, 'parent' => $comm->id, 'status' => 1])->get();
//        }
        //$comments = News::find($id)->news_comments()->where(['parent' => 0,'status' => 1]);
        //dd($comments);die;

        return view('frontEnd.news.newsDetails', compact('new'));
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
        News_comment::create([
            'user_id' => auth()->user()->id,
            'new_id' => $request->news_id,
            'comment' => $request->comment,
            'status' => 1,
            'parent' => $parent,
            'published_at' => date('y-m-d H:i:s')

        ]);

        session()->flash('message', 'تم اضافة التعليق');
        return back();
    }

    public function addComment(Request $request, $new_id)
    {
        if ($request->comment == '') {
            $url = URL::to('events/' . $new_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة التعليق اولا');
        }

        News_comment::create([
            'news_id' => $new_id,
            'comment' => $request->comment,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة تعليقك بنجاح');
        $url = URL::to('news/' . $new_id) . '#scroll';
        return Redirect::to($url);
    }

    public function editComment(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required',
        ], [
            'comment.required' => 'من فضلك اضف تعليقك',
        ], []);

        $comment = News_comment::find($request->commentID);

        $comment->comment = $request->comment;
        $comment->save();

    }

    public function addReply(Request $request, $new_id, $comment_id)
    {

        if ($request->reply == '') {
            $url = URL::to('news/' . $new_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة الرد اولا');
        }

        News_comment::create([
            'news_id' => $new_id,
            'comment' => $request->reply,
            'parent' => $comment_id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة الرد بنجاح');
        $url = URL::to('news/' . $new_id) . '#scroll';
        return Redirect::to($url);
    }

    public function deleteComment(Request $request, $new_id, $comment_id)
    {
        $comment = News_comment::find($comment_id);

        if ($comment->parent == 0) {
            News_comment::where('parent', '=', $comment->id)->delete();
        }
        $comment->delete();

        session()->flash('message', 'تم الحذف بنجاح !');
        $url = URL::to('news/' . $new_id) . '#scroll';
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
        News_comment::create([
            'user_id' => auth()->user()->id,
            'new_id' => $request->news_id,
            'comment' => $request->comment,
            'status' => 1,
            'parent' => $parent,
            'published_at' => date('y-m-d H:i:s')

        ]);

        session()->flash('message', 'تم اضافة التعليق');
        return back();
    }

    public function addComment2(Request $request, $new_id)
    {
        if ($request->comment == '') {
            $url = URL::to('events/' . $new_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة التعليق اولا');
        }

        News_comment::create([
            'news_id' => $new_id,
            'comment' => $request->comment,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة تعليقك بنجاح');
        $url = URL::to('health-details/' . $new_id) . '#scroll';
        return Redirect::to($url);
    }

    public function editComment2(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required',
        ], [
            'comment.required' => 'من فضلك اضف تعليقك',
        ], []);

        $comment = News_comment::find($request->commentID);

        $comment->comment = $request->comment;
        $comment->save();

    }

    public function addReply2(Request $request, $new_id, $comment_id)
    {

        if ($request->reply == '') {
            $url = URL::to('health-details/' . $new_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة الرد اولا');
        }

        News_comment::create([
            'news_id' => $new_id,
            'comment' => $request->reply,
            'parent' => $comment_id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة الرد بنجاح');
        $url = URL::to('health-details/' . $new_id) . '#scroll';
        return Redirect::to($url);
    }

    public function deleteComment2(Request $request, $new_id, $comment_id)
    {
        $comment = News_comment::find($comment_id);

        if ($comment->parent == 0) {
            News_comment::where('parent', '=', $comment->id)->delete();
        }
        $comment->delete();

        session()->flash('message', 'تم الحذف بنجاح !');
        $url = URL::to('health-details/' . $new_id) . '#scroll';
        return Redirect::to($url);
    }

}
