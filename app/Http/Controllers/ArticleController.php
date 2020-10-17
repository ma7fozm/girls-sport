<?php

namespace App\Http\Controllers;

use App\Articale;
use App\Article;
use App\Category;
use App\Articles_comments;
use App\Group;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('admin.articles.articlesManagment', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        $teams = Team::all();
        $groups = Group::all();

        return view('admin.articles.createArticle', compact('categories','users','teams','groups'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'intro' => 'required',
            'articleContent' => 'required',
            'articleImg' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
        ], [
            'title.required' => 'من فضلك ادخل  عنوان المقال ',
            'intro.required' => 'من فضلك ادخل مقدمة المقال ',
            'articleContent.required' => 'من فضلك محتوى المقال ',
            'articleImg.required' => 'من فضلك قم باختيار صورة المقال ',
            'category_id.required' => ' من فضلك قم باختيار الفئة المنتمى اليها هذا المقال ',
            'user_id.required' => ' من فضلك قم باختيار العضو المراد اضافة المقال له',
        ], [

        ]);
        $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];
        if ($request->category_id == 0) {
            $validationErrors[] = 'لابد من تحديد نوع هذا المقال';
        }


        if ($request->belongTo == '0') {
            $validationErrors[] = 'من فضلك لابد من تحديد الفئة التى تود اضافة  المقال اليها';
        }

   

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


        if ($request->belongTo == 'member') {
            if ($request->user_id != 0) {
                $saved=[
                    'title' => $request->title,
                    'intro' => $request->intro,
                    'status' => 1,
                    'article_type'=>3,
                    'content' => $request->articleContent,
                    'category_id' => $request->category_id,
                    'user_id' => $request->user_id,
                    'image' => $img_url,
                    'superadmin_id' => Auth::user()->id,
                     ];
                        if ( Auth::user()->roles_id == 1)
                        { 
                              $saved['public']=1;
                          
                        }
                        else{
                              $saved['public']=2;

                        }
                Article::create($saved);
                session()->flash('message', 'تم اضافة المقال');
                return redirect('admin/articles');
            }else {
                $validationErrors[] = 'من فضلك قم باختيار العضو التى تود اضافة هذا المقال له';
            }
        } else if ($request->belongTo == 'group') {
           
            if ($request->group_id != 0) {
           $saved=[  
                    'title' => $request->title,
                    'intro' => $request->intro,
                    'status' => 1,
                    'article_type'=>2,
                    'content' => $request->articleContent,
                    'category_id' => $request->category_id,
                    'group_id' => $request->group_id,
                    'image' =>  $img_url,
                    'superadmin_id' => Auth::user()->id,
                ];
           
                  
                   if ( Auth::user()->roles_id == 1)
                        { 
                              $saved['public']=1;
                          
                        }
                        else{
                              $saved['public']=2;

                        }
                     
               Article::create($saved);
                session()->flash('message', 'تم اضافة المقال');
                return redirect('admin/articles');
            } else {
                $validationErrors[] = 'من فضلك قم باختيار المجموعة التى تود اضافة هذا المقال اليها';
            }
        }else if ($request->belongTo == 'team') {
            if ($request->team_id != 0) {
              $saved=[ 
                     'title' => $request->title,
                    'intro' => $request->intro,
                    'status' => 1,
                    'article_type'=>1,
                    'content' => $request->articleContent,
                    'category_id' => $request->category_id,
                    'team_id' => $request->team_id,
                    'image' =>  $img_url,
                    'superadmin_id' => Auth::user()->id,
                     ];
                       if ( Auth::user()->roles_id == 1)
                        { 
                              $saved['public']=1;
                          
                        }
                        else{
                              $saved['public']=2;

                        }

                Article::create($saved);
                session()->flash('message', 'تم اضافة المقال');
                return redirect('admin/articles');
            } else {
                $validationErrors[] = 'من فضلك قم باختيار الفريق التى تود اضافة هذا المقال له';
            }
        }

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

//        session()->flash('message', 'تم اضافة المقال');
//        return redirect('admin/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articale  $articale
     * @return \Illuminate\Http\Response
     */
    public function show(Articale $articale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articale  $articale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $article = Article::find($id);
           $teams = Team::all();
        $groups = Group::all();

        $categories = Category::all();
        $users = User::all();
        return view('admin.articles.editArticle', compact('article', 'categories','users','groups','teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articale  $articale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'intro' => 'required',
            'articleContent' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'group_id' => 'required',
            'team_id' => 'required',
        ], [
            'title.required' => 'من فضلك ادخل  عنوان المقال',
            'intro.required' => 'من فضلك ادخل مقدمة المقال',
            'articleContent.required' => 'من فضلك محتوى المقال',
            'category_id.required' => ' من فضلك قم باختيار الفئة المنتمى اليها هذا المقال',
            'user_id.required' => ' من فضلك قم باختيار العضو المنتمى اليه هذا المقال',
             'team_id.required' => 'من فضلك قم بإختيار الفريق',
            'group_id.required' => 'من فضلك قم بإختيار المجموعه',


        ], [

        ]);

     $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];
     if ($request->hasFile('articleImg')) {
             
            $fileExtention = strtolower($request->articleImg->getClientOriginalExtension());
            if (!in_array($fileExtention, $imgExt)) {
                $validationErrors[] =  'هذة ليست بصورة او انك قمت باختيار صورة غير مدعومة';
            }
        }


        if ($request->category_id == 0) {
            $validationErrors[] = 'لابد من تحديد الفئة التى ينتمى اليها هذا المقال';
        }
        if ($request->user_id == 0) {
            $validationErrors[] = 'من فضلك قم باختيار العضو المراد اضافة المقال له';
        }
     

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

      if ($request->group_to == 'userR') {
     $article = Article::find($id);
        $article->title = $request->title;
        $article->intro = $request->intro;
        $article->content = $request->articleContent;
        $article->category_id = $request->category_id;
        $article->user_id = $request->user_id;
        $article->team_id = NULL;
        $article->group_id = NULL;
        $article->article_type=3;
 
           if (request()->hasfile('articleImg')) {
             File::delete($article->image);
            $file = request()->file('articleImg');
            $article_name = $request->articleImg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/articleImages/'), 'img_' . time() . "." . $ext);
                $article_path = 'uploads/images/articleImages/img_' . time() . "." . $ext;
                 $article->image = $article_path;


            } 
        }

                }


          if ($request->group_to == 'groupR') {

        
        $article = Article::find($id);
        $article->title = $request->title;
        $article->intro = $request->intro;
        $article->content = $request->articleContent;
        $article->category_id = $request->category_id;
        $article->article_type=2;
        $article->team_id = NULL;
        $article->user_id  = NULL;
        $article->group_id = $request->group_id;

           if (request()->hasfile('articleImg')) {
             File::delete($article->image);
            $file = request()->file('articleImg');
            $article_name = $request->articleImg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/articleImages/'), 'img_' . time() . "." . $ext);
                $article_path = 'uploads/images/articleImages/img_' . time() . "." . $ext;
                 $article->image = $article_path;


            } 
        }

                }


          if ($request->group_to == 'teamR') {

          
      $article = Article::find($id);
        $article->title = $request->title;
        $article->intro = $request->intro;
        $article->content = $request->articleContent;
        $article->category_id = $request->category_id;
        $article->article_type=1;
       $article->user_id  = NULL;
        $article->group_id = Null;
        $article->team_id = $request->team_id;

           if (request()->hasfile('articleImg')) {
             File::delete($article->image);
            $file = request()->file('articleImg');
            $article_name = $request->articleImg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/articleImages/'), 'img_' . time() . "." . $ext);
                $article_path = 'uploads/images/articleImages/img_' . time() . "." . $ext;
                 $article->image = $article_path;


            } 
        }
                }

        $article->save();
        session()->flash('message', 'تم تعديل البيانات بنجاح');
        return redirect('admin/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articale  $articale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
         File::delete($article->image);
         $article->delete();
        session()->flash('message', 'تم حذف بيانات المقال بنجاح');
        return back();
    }
    
    public function deleteArticleComment($id)
    {
        Articles_comments::find($id)->delete();
        Articles_comments::where('parent', '=', $id)->delete();
        session()->flash('message', 'تم حذف التعليق بنجاح');
        return back();
    }

    public function deleteArticleCommentReply($id)
    {
        Articles_comments::find($id)->delete();
        session()->flash('message', 'تم حذف الرد بنجاح');
        return back();
    }

    public function active($id)
    {
        $article = Article::find($id);
        $article->status = 0;
        $article->save();

        session()->flash('message', 'تم حظر المقال');
        return back();
    }

    public function unactive($id)
    {
        $article = Article::find($id);
        $article->status = 1;
        $article->save();


        session()->flash('message', 'تم تنشيط المقال');
        return back();
    }

    public function activeComment($id)
    {
        $article = Articles_comments::find($id);
        $article->status = 0;
        $article->save();

        session()->flash('message', 'تم حظر التعليق');
        return back();
    }

    public function unactiveComment($id)
    {
        $article = Articles_comments::find($id);
        $article->status = 1;
        $article->save();

        session()->flash('message', 'تم تفعيل التعليق بنجاح');
        return back();
    }

    public function showArticleComments($id)
    {
        $article = article::find($id);
        $comments = article::find($id)->comments->where('parent', '=', 0);
        return view('admin/articles/articleCommentsManagment', compact('article', 'comments'));

    }

    public function showCommentReplies($id)
    {
        $replies = Articles_comments::find($id)->replies;
        $comment = Articles_comments::find($id);
        return view('admin/articles/articleCommentReplies', compact('replies', 'comment'));

    }

    public function storeArticleReply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ], ['reply.required' => 'قم بكتابة الرد اولا',], []);

        $article_id = Articles_comments::find($id)->article->id;

        Articles_comments::create([
            'article_id' => $article_id,
            'comment' => $request->reply,
            'parent' => $id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        return back();

    }
       public function storeArticlecomment(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ], ['reply.required' => 'قم بكتابة الرد اولا',], []);

        // $new_id = News_comment::find($id)->news->id;

        Articles_comments::create([
            'article_id' => $id,
            'comment' => $request->reply,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        return back();


    }

    public static function convertArabicNumbers($string) {
        //$engish = array(0,1,2,3,4,5,6,7,8,9);
        static $fromchar = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        static $num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($num, $fromchar, $string);
    }

}
