<?php

namespace App\Http\Controllers;

use App\Match;
use App\Team;
use App\MatchTeam;
use App\Matches_comments;
use App\Leagues;
use foo\bar;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


class MatchController_front extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_matchs = Match::orderBy('id','desc')->paginate('8');

        foreach ($all_matchs as $match) {
            if ($match->match_type == 'single') {
                $indvMatchs[] = $match;
            } else if ($match->match_type == 'team') {

                $teamMatchs[] = $match;
            }
        }
        return view('frontEnd.match.match',compact('indvMatchs','teamMatchs','all_matchs'));
    }
    public function showPublicMatch()
    {
      
       //$all_matchs = Match::where(['status' => 1])->orderBy('id','desc')->paginate('5');
       //$all_leagues = Leagues::where(['status' => 1])->orderBy('id','desc')->paginate('5');



        $matches_per_page = 5;
        $leagues_per_page = 5;
        $all_matchs = Match::where(['status' => 1])->orderBy('id','desc')->paginate($matches_per_page);
        $all_matchs_count = Match::where(['status' => 1])->orderBy('id','desc')->count();
       $all_leagues = Leagues::where(['status' => 1])->orderBy('id','desc')->paginate($leagues_per_page);
        $all_leagues_count = Leagues::where(['status' => 1])->orderBy('id','desc')->count();

        $count_res = ['matches' => ceil($all_matchs_count / $matches_per_page), 'leagues' => ceil($all_leagues_count / $leagues_per_page)];
        //$count_res=['images' => 3,'videos' => 9];
        $max_length = array_search(max($count_res), $count_res);

      

        // $health = News::where('news_type','=','صحه')->orderBy('id','desc')->paginate(6);
        return view('frontEnd.matches.match', compact('all_matchs','all_leagues', 'max_length'));
    }
       public function showPublicMatchDetails($id)
    {
       
     $teams = Team::all();
       $match = Match::find($id);
  
         
        return view('frontEnd.matches.MatchDetails', compact('match','teams'));
    
    }
      public function showPublicLeagueDetails($id)
    {
       
        // $matchs = match::all();
        $Leagues = Leagues::find($id);
       
         
        return view('frontEnd.matches.league-details', compact('Leagues'));
    
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showMatchDetails($id){
        $match = Match::find($id);
        return view('frontEnd.match.match_details',compact('match'));
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
        Matches_comments::create([
            'user_id' => auth()->user()->id,
            'match_id' => $request->match_id,
            'comment' => $request->comment,
            'status' => 1,
            'parent' => $parent,
            'published_at' => date('y-m-d H:i:s')

        ]);

        session()->flash('message', 'تم اضافة التعليق');
        return back();
    }

    public function addComment(Request $request, $match_id)
    {
        if ($request->comment == '') {
            $url = URL::to('events/' . $match_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة التعليق اولا');
        }

        Matches_comments::create([
            'match_id' => $match_id,
            'comment' => $request->comment,
            'parent' => 0,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة تعليقك بنجاح');
        $url = URL::to('match-details/' . $match_id) . '#scroll';
        return Redirect::to($url);
    }

    public function editComment(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required',
        ], [
            'comment.required' => 'من فضلك اضف تعليقك',
        ], []);

        $comment = Matches_comments::find($request->commentID);

        $comment->comment = $request->comment;
        $comment->save();

    }

    public function addReply(Request $request, $match_id, $comment_id)
    {

        if ($request->reply == '') {
            $url = URL::to('match-details/' . $match_id) . '#scroll';
            return Redirect::to($url)->withErrors('قم بكتابة الرد اولا');
        }

        Matches_comments::create([
            'match_id' => $match_id,
            'comment' => $request->reply,
            'parent' => $comment_id,
            'user_id' => Auth::user()->id,
            'status' => 1,
        ]);

        session()->flash('message', 'تم اضافة الرد بنجاح');
        $url = URL::to('match-details/' . $match_id) . '#scroll';
        return Redirect::to($url);
    }

    public function deleteComment(Request $request, $match_id, $comment_id)
    {
        $comment = Matches_comments::find($comment_id);

        if ($comment->parent == 0) {
            Matches_comments::where('parent', '=', $comment->id)->delete();
        }
        $comment->delete();

        session()->flash('message', 'تم الحذف بنجاح !');
        $url = URL::to('match-details/' . $match_id) . '#scroll';
        return Redirect::to($url);
    }
}
