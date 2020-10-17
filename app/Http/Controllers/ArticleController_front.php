<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Articles_comments;
use App\Notifications\upgradeProfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ArticleController_front extends Controller
{
    public function index(Request $request)
    {

        $groups = User::find(Auth::user()->id)->groups;
        $teams = User::find(Auth::user()->id)->teams;
        $categories = Category::where('status', '=', 1)->get();
        $articles = User::find(Auth::user()->id)->articles()->where('status', '=', 1)->paginate(5);
        $user = Auth::user();

        return view('frontEnd.articles.article_profile', compact('groups', 'teams', 'categories', 'articles', 'user'));

    }

    public function showActivationPage()
    {
        $teams = User::find(Auth::user()->id)->teams;
        $sports = User::find(Auth::user()->id)->sports;
        return view('frontEnd.users.activation', compact('teams', 'sports'));
    }

    public function storeActivationData(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

       $this->validate($request, [
                'personal_proof' => 'required|mimes:jpeg,jpg,png,gif|max:100000',
                'guarantor_name' => 'required',
                'guarantor_email' => 'required|nullable|email',
                'guarantor_phone' => 'required|nullable|numeric|digits:11',
            ], [
                'personal_proof.required' => 'من فضلك قم بتحديد اثبات شخصية للعضو',
                'guarantor_name.required' => 'من فضلك قم بادخال اسم الضامن',
                'guarantor_email.required' => 'من فضلك قم بادخال البريد الالكترونى لضامن العضو',
                'guarantor_email.email' => 'من فضلك قم بادخال البريد الالكترونى صالح لضامن العضو',
                'guarantor_phone.required' => 'من فضلك قم بادخال رقم جوال الضامن',
                'guarantor_phone.numeric' => 'يجب ان يحتوى رقم الجوال على ارقام فقط',
                'guarantor_phone.digits' => 'يجب ان يحتوى رقم الجوال على 11 رقم',
            ], [

            ]);



        if (request()->hasfile('personal_proof')) {

            File::delete($user->personal_proof);
            $img = request()->file('personal_proof');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/personalProofs/'), 'img_' . time() . "." . $ext);
            $personalProof_path = 'uploads/images/personalProofs/img_' . time() . "." . $ext;
        } else {
            $personalProof_path = $user->personal_proof;
        }

        $user->personal_proof = $personalProof_path;
        $user->guarantor_name = $request->guarantor_name;
        $user->guarantor_email = $request->guarantor_email;
        $user->guarantor_phone = $request->guarantor_phone;
        $user->upgrade = 1;
        $user->save();

        $admin_users = User::where('roles_id','=',1)->get();
        foreach ($admin_users as $user){
            $user->notify(new upgradeProfile(Auth::user()));
        }

        session()->flash('message', 'تم ارسال طلب الترقيه  لادارة الموقع ');
        return redirect('personal/info');
    }

    public function showUserArticleDetails($id)
    {

        $article = Article::find($id);

        return view('frontEnd.articles.article-details', compact('article'));
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
        Articles_comments::create([
            'user_id' => auth()->user()->id,
            'article_id' => $request->article_id,
            'comment' => $request->comment,
            'status' => 1,
            'parent' => $parent,
            'published_at' => date('y-m-d H:i:s')

        ]);

        session()->flash('message', 'تم اضافة التعليق');
        return back();
    }

    public function addComment(Request $request, $article_id)
    {
        if ($request->comment == '') {
            $url = URL::to('events/' . $article_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة التعليق اولا');
        }

        Articles_comments::create([
            'article_id' => $article_id,
            'comment' => $request->comment,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة تعليقك بنجاح');
        $url = URL::to('article-details/' . $article_id) . '#scroll';
        return Redirect::to($url);
    }

    public function editComment(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required',
        ], [
            'comment.required' => 'من فضلك اضف تعليقك',
        ], []);

        $comment = Articles_comments::find($request->commentID);

        $comment->comment = $request->comment;
        $comment->save();

    }

    public function addReply(Request $request, $article_id, $comment_id)
    {

        if ($request->reply == '') {
            $url = URL::to('article-details/' . $article_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة الرد اولا');
        }

        Articles_comments::create([
            'article_id' => $article_id,
            'comment' => $request->reply,
            'parent' => $comment_id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة الرد بنجاح');
        $url = URL::to('article-details/' . $article_id) . '#scroll';
        return Redirect::to($url);
    }

    public function deleteComment(Request $request, $article_id, $comment_id)
    {
        $comment = Articles_comments::find($comment_id);

        if ($comment->parent == 0) {
            Articles_comments::where('parent', '=', $comment->id)->delete();
        }
        $comment->delete();

        session()->flash('message', 'تم الحذف بنجاح !');
        $url = URL::to('article-details/' . $article_id) . '#scroll';
        return Redirect::to($url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ;
        $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];
        $img_url = "";

        if (request()->hasfile('articleImg')) {

            $file = request()->file('articleImg');
            $news_name = $request->articleImg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/articleImages/'), 'img_' . time() . "." . $ext);
                $news_path = 'uploads/images/articleImages/img_' . time() . "." . $ext;
                $img_url = $news_path;
                // $saved['image']=$img_url;

            }
        }

        if ($request->category_id == 0) {
            return response()->json(['error' => 'من فضلك قم باختيار الفئة التى ينتمى اليها هذا المقال'], 422);
        }

        if ($request->belongTo == 'profile') {
            Article::create([
                'title' => $request->title,
                'intro' => $request->intro,
                'status' => 1,
                'public' => 2,
                'content' => $request->articleContent,
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'image' => $img_url,
            ]);
            return redirect('/articles');
        } else if ($request->belongTo == 'group') {
            if ($request->group_id != 0) {
                Article::create([
                    'title' => $request->title,
                    'intro' => $request->intro,
                    'status' => 0,
                    'public' => 2,
                    'content' => $request->articleContent,
                    'category_id' => $request->category_id,
                    'group_id' => $request->group_id,
                    'image' => $img_url,
                    'user_id' => Auth::user()->id,
                ]);
                return redirect('/articles');
            } else {
                return response()->json(['error' => 'من فضلك قم باختيار المجموعة التى تود اضافة هذا المقال اليها'], 422);

            }
        } else if ($request->belongTo == 'team') {
            if ($request->team_id != 0) {
                Article::create([
                    'title' => $request->title,
                    'intro' => $request->intro,
                    'status' => 0,
                    'public' => 2,
                    'content' => $request->articleContent,
                    'category_id' => $request->category_id,
                    'team_id' => $request->team_id,
                    'image' => $img_url,
                    'user_id' => Auth::user()->id,
                ]);
                return redirect('/articles');
            } else {
                return response()->json(['error' => 'من فضلك قم باختيار الفريق التى تود اضافة هذا المقال له'], 422);

            }
        }


        Article::create([
            'title' => $request->title,
            'intro' => $request->intro,
            'status' => 1,
            'public' => 2,
            'content' => $request->articleContent,
            'image' => $img_url,
        ]);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
