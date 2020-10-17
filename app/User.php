<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    public $table = "users";

    protected $fillable = [
        'name', 'username', 'plain_password', 'password','city_id','govarea_id','type','upgrade','frist_log', 'email', 'image', 'verify_token', 'countries_id', 'city', 'cv_link', 'roles_id', 'status', 'email_verified_at', 'personal_proof', 'guarantor_name', 'guarantor_email', 'guarantor_phone', 'remember_token', 'created_at', 'updated_at'
    ];

//    public function teamAdmin(){
//        return $this->hasOne(Team::class,'user_id');
//    }

    public function countries()
    {
        return $this->belongsTo(Countries::class);
    }

    public function govarea()
    {
        return $this->belongsTo(GovArea::class,'govarea_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function cities()
    {
        return $this->belongsTo(Country_City::class,'city');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user')->orderBy('id','desc')->withPivot('status');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_users')->orderBy('id','desc')->withPivot('status');
    }

//    public function event(){
//        return $this->belongsToMany(Event::class,'event_users')->where('user_id','=',Auth::user()->id)->withPivot('status');
//    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user')->orderBy('id','desc')->withPivot('status');
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function mediaPag()
    {
        return $this->hasMany(Media::class)->orderBy('id', 'desc')->paginate(10);
    }

    public function gallaryPag()
    {
        return $this->hasMany(Media::class)->where('public', '=', '1')->orderBy('id', 'desc')->paginate(10);
    }

    public function articles()
    {
        return $this->hasMany(Article::class)->orderBy('id','desc');
    }

    public function matchs()
    {
        return $this->belongsToMany(Match::class, 'match_team');
    }

    public function news_comments()
    {
        return $this->hasMany(News_comments::class);
    }

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'sport_user')->withPivot('status','type');
    }

    public function role(){
        return $this->belongsTo(role::class,'roles_id');
    }

    public function messages(){
        return $this->hasMany(Message::class,'user_id')->orderBy('id','desc');
    }
}
