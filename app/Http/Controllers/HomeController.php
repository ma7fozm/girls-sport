<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Country_City;
use App\GovArea;
use App\Media;
use App\News;
use App\Place;
use App\Sport;
use App\Team;
use App\User;
use Auth;
use App\Country;
use App\Role;
use App\Event;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;


class HomeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $news = News::where('news_type', '=', 'عام')->where('status', '=', 1)->orderBy('id', 'desc')->get()->take(3);
        $images = Media::orderBy('id', 'desc')->where('public', '=', 1)->where('type', '=', 'صورة')->where('status', '=', 1)->get()->take(10);
        $videos = Media::orderBy('id', 'desc')->where('public', '=', 1)->where('type', '=', 'فيديو')->where('status', '=', 1)->get()->take(3);
        $healthNews = News::where('news_type', '=', 'صحه')->where('status', '=', 1)->orderBy('id', 'desc')->get()->take(10);
        $indvSports = Sport::where(['status' => 1, 'type' => 'فرديه'])->orderBy('id', 'desc')->get()->take(3);
        $teamSports = Sport::where(['status' => 1, 'type' => 'جماعيه'])->orderBy('id', 'desc')->get()->take(3);
        $events = Event::where('status', '=', 1)->orderBy('id', 'desc')->take(4)->get()->toArray();
        $places = Place::where('status', '=', 1)->orderBy('id', 'desc')->take(4)->get()->toArray();
        $sports = Sport::where('status', '=', 1)->orderBy('id', 'desc')->take(5)->get()->toArray();
        $teams = Team::where('status', '=', 1)->orderBy('id', 'desc')->take(5)->get()->toArray();
        $slider_images = Media::inRandomOrder()->where('status', '=', 1)->where('public', '=', 1)->where('type', '=', 'صورة')->get()->take(10);

        if (!empty($sports)) {
            $sport = $sports[array_rand($sports)];
        }

        if (!empty($teams)) {
            $team = $teams[array_rand($teams)];
        }

        if (!empty($events)) {
            $event = $events[array_rand($events)];
        }

        if (!empty($places)) {
            $place = $places[array_rand($places)];
        }

        return view('frontEnd.index', compact('news', 'images', 'videos', 'healthNews', 'events', 'event', 'places', 'place', 'sports', 'sport', 'teams', 'team', 'slider_images','teamSports','indvSports'));
    }

    public function indexForAdmin()
    {
        $user = Auth::user();
        $user_role = Role::find($user->roles_id);
        if ($user_role->name == 'Super admin') {
            return view('admin.index');
        } else {
            return view('/home');
        }
    }

    public function ConfirmRegistration()
    {
        $user = Auth::user();
        return view('users.edit')
            ->with('countries', Country::all())
            ->with('user', $user);
    }

    public function CheckIfLogin()
    {
        if ($user = Auth::user()) {
            $user_role = Role::find($user->roles_id);
            if ($user_role->name == 'Super admin') {
                return redirect('admin/');
            } else {
                return redirect('index');
            }
        } else {
            return redirect('index');
        }

    }

    public function ShowEvents()
    {
        if (Auth::user()) {
            $user_role = Role::find(Auth::user()->roles_id);
            $teams = Auth::user()->teams;
            return view('FrontEnd.events')
                ->with('user_role', $user_role->name)
                ->with('events', Event::paginate(8))
                ->with('teams', $teams);
        } else {
            return view('FrontEnd.events')
                ->with('user_role', 'guest')
                ->with('events', Event::paginate(8));

        }
    }

    public function search(Request $request)
    {
//        $search = new Search();
//        $searchResults = (new Search())
//            ->registerModel($request->models['0'], $request->col_name[0])
//            ->perform($request->input('query'));

        $search = new Search();

        for ($i = 0; $i < count($request->models); $i++) {
            $search->registerModel($request->models[$i], $request->col_name[$i]);
        }

        $searchResults = $search->perform($request->input('query'));
        return view('search', compact('searchResults'));
    }

    public function getCountryCities(Request $request)
    {
        $govarea_id = $request->govareaID;
        $cities = GovArea::find($govarea_id)->cities;
        $res[0] = $cities;

        if ($request->user_id != null) {
            $use = User::find($request->user_id);
            $res[1] = $use->city_id;
        } else {
            if (isset(auth()->user()->id)) {
                $res[1] = auth()->user()->city_id;
            }
        }
        return response($res);
    }

    public function getCountryGovareas(Request $request)
    {
        $country_id = $request->countryID;
        $govareas = Countries::find($country_id)->govareas;
        $type = Countries::find($country_id)->type;
        $res[0] = $govareas;
        $res[1] = $type;
        if ($request->user_id != null) {
            $use = User::find($request->user_id);
            $res[2] = $use->govarea_id;
        } else {
            if (isset(auth()->user()->id)) {
                $res[2] = auth()->user()->govarea_id;
            }
        }


        return response($res);
    }
    
        public static function ArabicDate($date) {
        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
//        $your_date = date('y-m-d'); // The Current Date
        $your_date = $date; // The Current Date
        $en_month = date("M", strtotime($your_date));
        foreach ($months as $en => $ar) {
            if ($en == $en_month) { $ar_month = $ar; }
        }

        $find = array ("Sat", "Sun", "Mon", "Tue", "Wed" , "Thu", "Fri");
        $replace = array ("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        $ar_day_format = date('D'); // The Current Day
        $ar_day = str_replace($find, $replace, $ar_day_format);

        header('Content-Type: text/html; charset=utf-8');
        $standard = array("0","1","2","3","4","5","6","7","8","9");
        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
//        $current_date = $ar_day.' '.date('d').' / '.$ar_month.' / '.date('Y');

        $current_date = ' '.date('d', strtotime($your_date)).'  '.$ar_month.'  '.date('Y', strtotime($your_date));
        $arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);

        return $arabic_date;
    }

}
