<?php

namespace App\Http\Controllers;
use App\Category;
use App\News;
use App\News_comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return view('admin.news.newsManagment', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.news.createNew', compact('categories'));
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
            'title' => 'required',
            'intro' => 'required',
            'news_type' => 'required',
            'newContent' => 'required',
            'newImg' => 'required',
            'category_id' => 'required',
        ], [
            'title.required' => 'من فضلك ادخل  عنوان للخبر',
            'news_type.required' => 'من فضلك ادخل  تصنيف الخبر',

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

        $saved=[
            'title' => $request->title,
            'intro' => $request->intro,
            'user_id' => Auth::user()->id,
            'status' => $request->status,
            'content' => $request->newContent,
            'news_type' => $request->news_type,
            'category_id' => $request->category_id,
           // 'image' => $img_url,
        ];

        if (request()->hasfile('newImg')) {

            $file = request()->file('newImg');
            $news_name = $request->newImg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/newsImages/'), 'img_' . time() . "." . $ext);
                $news_path = 'uploads/images/newsImages/img_' . time() . "." . $ext;
                  $img_url = $news_path;
                  $saved['image']=$img_url;

            } 
        }

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

        News::create($saved);


        session()->flash('message', 'تم اضافة الخبر');
        return redirect('admin/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = News::find($id);
        $categories = Category::all();
        return view('admin.news.editNew', compact('new', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'intro' => 'required',
            'newContent' => 'required',
            'category_id' => 'required',
            'news_type' => 'required',
        ], [
            'title.required' => 'من فضلك ادخل  عنوان للخبر',
            'news_type.required' => 'من فضلك ادخل  تصنيف الخبر',
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
        $new->news_type = $request->news_type;
        $new->status = $request->status;

        $new->category_id = $request->category_id;


        if (request()->hasfile('newImg')) {
             File::delete($new->image);
            $file = request()->file('newImg');
            $news_name = $request->newImg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/newsImages/'), 'img_' . time() . "." . $ext);
                $news_path = 'uploads/images/newsImages/img_' . time() . "." . $ext;
                 $new->image = $news_path;

            } 
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
        $news=News::find($id);
         File::delete($news->image);
        $news->delete();
        session()->flash('message', 'تم حذف بيانات الجروب بنجاح');
        return back();
    }
       public function deleteNewsComment($id)
    {
        News_comment::find($id)->delete();
        News_comment::where('parent', '=', $id)->delete();
        session()->flash('message', 'تم حذف التعليق بنجاح');
        return back();
    }

    public function deleteNewsCommentReply($id)
    {
        News_comment::find($id)->delete();
        session()->flash('message', 'تم حذف الرد بنجاح');
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

        public function activeComment($id)
    {
        $new = News_comment::find($id);
        $new->status = 0;
        $new->save();

        session()->flash('message', 'تم حظر التعليق');
        return back();
    }

    public function unactiveComment($id)
    {
        $new = News_comment::find($id);
        $new->status = 1;
        $new->save();

        session()->flash('message', 'تم تفعيل التعليق بنجاح');
        return back();
    }
       public function showNewsComments($id)
    {
        $new = News::find($id);
        $comments =News::find($id)->comments->where('parent', '=', 0);
        return view('admin/news/newsCommentsManagment', compact('new', 'comments'));

    }

 public function showCommentReplies($id)
    {
        $replies = News_comment::find($id)->replies;
        $comment = News_comment::find($id);
        return view('admin/news/newsCommentReplies', compact('replies', 'comment'));

    }
 public function storeNewsReply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ], ['reply.required' => 'قم بكتابة الرد اولا',], []);

        $new_id = News_comment::find($id)->news->id;

        News_comment::create([
            'news_id' => $new_id,
            'comment' => $request->reply,
            'parent' => $id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        return back();


    }
     public function storeNewscomment(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ], ['reply.required' => 'قم بكتابة الرد اولا',], []);

        // $new_id = News_comment::find($id)->news->id;

        News_comment::create([
            'news_id' => $id,
            'comment' => $request->reply,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        return back();


    }

}

