<?php

namespace App\Http\Controllers;
use App\Match;
use DB;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $events=DB::table('events')->count();
        $matches=DB::table('matches')->count();
        $sports=DB::table('sports')->count();
        $teams=DB::table('teams')->count();
        $groups=DB::table('groups')->count();
        $super=User::where('roles_id','1')->count();
        $fan=User::where('roles_id','2')->count();
        $investor=User::where('roles_id','3')->count();
        $belongplayer=User::where('roles_id','4')->count();
        $belongadmin=User::where('roles_id','5')->count();

       // $articles = Article::all();
        return view('admin.index', compact('events','matches','sports','teams','super','groups','fan','investor','belongplayer', 'belongadmin'));
    }

    public function showabout()
    {
        $teams=DB::table('teams')->count();
        $events=DB::table('events')->count();
        $matches=DB::table('matches')->count();
        $belongplayer=User::where('roles_id','4')->count();
        return view('frontEnd.about', compact('events','matches','teams','belongplayer'));
    }
      public function showfqa()
    {
        return view('frontEnd.faq');
    }
     public function showconditions()
    {
        return view('frontEnd.conditions');
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
}
