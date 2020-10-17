<?php

namespace App\Http\Controllers;
use App\Leagues;
use App\Leagues_comments;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class LeaguesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues = Leagues::all();
        return view('admin.Leagues.LeaguesManagment', compact('leagues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Leagues.createleague');

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
            'description' => 'required',
            'leagueImg' => 'required',
        ], [
            'name.required' => 'من فضلك ادخل اسم الدوري',
            'description.required' => 'من فضلك ادخل وصف الدوري',
            'leagueImg.required' => 'من فضلك ادخل صوره الدوري',
        ], [

        ]);
        $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];
      

        $saved=[
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'status' => $request->status,
        ];

        if (request()->hasfile('leagueImg')) {

            $file = request()->file('leagueImg');
            $leagues_name = $request->leagueImg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/leaguesImages/'), 'img_' . time() . "." . $ext);
                $leagues_path = 'uploads/images/leaguesImages/img_' . time() . "." . $ext;
                  $img_url = $leagues_path;
                  $saved['image']=$img_url;

            } 
        }

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

        Leagues::create($saved);


        session()->flash('message', 'تمت إضافه الدوري');
        return redirect('admin/Leagues');
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
       $league = Leagues::find($id);
    
        return view('admin.Leagues.editleague', compact('league'));
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
            'description' => 'required',
           
        ], [
            'name.required' => 'من فضلك ادخل اسم الدوري',
            'description.required' => 'من فضلك ادخل وصف الدوري',
      
        ], [

        ]);
        $imgExt = ['jpg', 'png', 'gif', 'tif', 'tiff'];

        if ($request->hasFile('leagueImg')) {
             
            $fileExtention = strtolower($request->leagueImg->getClientOriginalExtension());
            if (!in_array($fileExtention, $imgExt)) {
                $validationErrors[] = 'هذة ليست بصورة او انك قمت باختيار صورة غير مدعومة';
            }
        }

        if (isset($validationErrors)) {
            return back()->withErrors($validationErrors);
        }

        $league =Leagues::find($id);
        $league->name = $request->name;
        $league->description = $request->description;
        $league->status = $request->status;

        if (request()->hasfile('leagueImg')) {
             File::delete($league->image);
            $file = request()->file('leagueImg');
            $leagues_name = $request->leagueImg->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $imgExt)) {

                $file_type = 'صورة';
                $file->move(public_path('uploads/images/leaguesImages/'), 'img_' . time() . "." . $ext);
                $leagues_path = 'uploads/images/leaguesImages/img_' . time() . "." . $ext;
                 $league->image = $leagues_path;

            } 
        }
       

        $league->save();
        session()->flash('message', 'تم تعديل البيانات بنجاح');
        return redirect('admin/Leagues');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $league = Leagues::find($id);
         File::delete($league->image);
         $league->delete();
        session()->flash('message', 'تم حذف بيانات الدوري بنجاح');
        return back();
    }
        public function active($id)
    {
         $league = Leagues::find($id);
        $league->status = 0;
        $league->save();

        session()->flash('message', 'تم الغاء تفعيل الدوري');
        return back();
    }

    public function unactive($id)
    {
        $league = Leagues::find($id);
       $league->status = 1;
       $league->save();

        session()->flash('message', 'تم تفعيل الدوري بنجاح');
        return back();
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
        Leagues_comments::create([
            'user_id' => auth()->user()->id,
            'league_id' => $request->league_id,
            'comment' => $request->comment,
            'status' => 1,
            'parent' => $parent,
            'published_at' => date('y-m-d H:i:s')

        ]);

        session()->flash('message', 'تم اضافة التعليق');
        return back();
    }

    public function addComment(Request $request, $league_id)
    {
        if ($request->comment == '') {
            $url = URL::to('events/' . $league_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة التعليق اولا');
        }

        Leagues_comments::create([
            'leagues_id' => $league_id,
            'comment' => $request->comment,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة تعليقك بنجاح');
        $url = URL::to('league-details/' . $league_id) . '#scroll';
        return Redirect::to($url);
    }

    public function editComment(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required',
        ], [
            'comment.required' => 'من فضلك اضف تعليقك',
        ], []);

        $comment = Leagues_comments::find($request->commentID);

        $comment->comment = $request->comment;
        $comment->save();

    }

    public function addReply(Request $request, $league_id, $comment_id)
    {

        if ($request->reply == '') {
            $url = URL::to('league-details/' . $league_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة الرد اولا');
        }

        Leagues_comments::create([
            'leagues_id' => $league_id,
            'comment' => $request->reply,
            'parent' => $comment_id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة الرد بنجاح');
        $url = URL::to('league-details/' . $league_id) . '#scroll';
        return Redirect::to($url);
    }

    public function deleteComment(Request $request, $league_id, $comment_id)
    {
        $comment = Leagues_comments::find($comment_id);

        if ($comment->parent == 0) {
            Leagues_comments::where('parent', '=', $comment->id)->delete();
        }
        $comment->delete();

        session()->flash('message', 'تم الحذف بنجاح !');
        $url = URL::to('league-details/' . $league_id) . '#scroll';
        return Redirect::to($url);
    }
   public function deleteLeagueComment($id)
    {
        Leagues_comments::find($id)->delete();
        Leagues_comments::where('parent', '=', $id)->delete();
        session()->flash('message', 'تم حذف التعليق بنجاح');
        return back();
    }

    public function deleteLeagueCommentReply($id)
    {
        Leagues_comments::find($id)->delete();
        session()->flash('message', 'تم حذف الرد بنجاح');
        return back();
    }

 

    public function activeComment($id)
    {
        $league = Leagues_comments::find($id);
        $league->status = 0;
        $league->save();

        session()->flash('message', 'تم حظر التعليق');
        return back();
    }

    public function unactiveComment($id)
    {
        $league = Leagues_comments::find($id);
        $league->status = 1;
        $league->save();

        session()->flash('message', 'تم تفعيل التعليق بنجاح');
        return back();
    }

    public function showLeagueComments($id)
    {
        $league = Leagues::find($id);
        $comments = Leagues::find($id)->comments->where('parent', '=', 0);
        return view('admin/Leagues/leagueCommentsManagment', compact('league', 'comments'));

    }

    public function showCommentReplies($id)
    {
        $replies = Leagues_comments::find($id)->replies;
        $comment = Leagues_comments::find($id);
        return view('admin/Leagues/leagueCommentReplies', compact('replies', 'comment'));

    }

    public function storeLeagueReply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ], ['reply.required' => 'قم بكتابة الرد اولا',], []);

        $league_id = Leagues_comments::find($id)->league->id;

        Leagues_comments::create([
            'leagues_id' => $league_id,
            'comment' => $request->reply,
            'parent' => $id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        return back();

    }
       public function storeLeaguecomment(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ], ['reply.required' => 'قم بكتابة الرد اولا',], []);

        // $new_id = News_comment::find($id)->news->id;

       Leagues_comments::create([
            'leagues_id' => $id,
            'comment' => $request->reply,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        return back();


    }


}
