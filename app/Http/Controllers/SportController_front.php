<?php

namespace App\Http\Controllers;

use App\News;
use App\News_comment;
use App\Sport;
use Illuminate\Http\Request;

class SportController_front extends Controller
{

    public function index()
    {
        $indvSports_per_page = 12;
        $teamSports_per_page = 12;
        $news_per_page = 3;

//        $indvSports = Sport::where(['status' => 1, 'type' => 'فرديه'])->orderBy('id', 'desc')->paginate($indvSports_per_page);
//        $teamSports = Sport::where(['status' => 1, 'type' => 'جماعيه'])->orderBy('id', 'desc')->paginate($teamSports_per_page);

        $indvSports = Sport::where(['status' => 1, 'type' => 'فرديه'])->orderBy('id', 'desc')->get();
        $teamSports = Sport::where(['status' => 1, 'type' => 'جماعيه'])->orderBy('id', 'desc')->get();

        $news = News::where('status', '=', 1)->where('news_type', '=', 'رياضه')->orderBy('id', 'desc')->paginate($news_per_page);
        $sports = Sport::where('status', '=', 1)->orderBy('id', 'desc')->take(15)->get();
        $all_indvSports_count = Sport::where(['status' => 1, 'type' => 'فرديه'])->count();
        $all_teamSports_count = Sport::where(['status' => 1, 'type' => 'جماعيه'])->count();
        $all_news_count = News::where('status', '=', 1)->where('news_type', '=', 'رياضه')->count();

        $count_res = ['individuals' => ceil($all_indvSports_count / $indvSports_per_page), 'teams' => ceil($all_teamSports_count / $teamSports_per_page), 'news' => ceil($all_news_count / $news_per_page)];
        $max_length = array_search(max($count_res), $count_res);
        $count = 1;

        return view('frontEnd.sports.sport', compact('indvSports', 'teamSports', 'news', 'sports', 'max_length', 'count'));
    }

    public function show($id)
    {
        $sport = Sport::find($id);

        if ($sport->type == 'جماعيه') {
            $teams = Sport::find($id)->teams()->orderBy('id', 'desc')->get();
        }
        elseif ($sport->type == 'فرديه') {
            $users = Sport::find($id)->members;
            $groups = $sport->groups;
        }

        if (isset($teams)){
            return view('frontEnd.sports.SportDetails', compact('sport', 'teams'));
        }else{
            return view('frontEnd.sports.SportDetails', compact('sport','users','groups'));
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
