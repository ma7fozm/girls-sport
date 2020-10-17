<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Team extends Model implements Searchable
{
    public $table = "teams";

    protected $fillable = [
        'name', 'description','created_at','status','sport_id','slogan','updated_at','user_id','admin_id'
    ];

    public function teamAdmin(){
        return $this->belongsTo(User::class,'admin_id');
    }

    public function users(){
        return $this->belongsToMany(User::class , 'team_user')->withPivot('status');;
    }

    public function medias(){
        return $this->hasMany(Media::class)->orderBy('id','desc');
    }

    public function groups(){
        return $this->hasMany(Group::class)->orderBy('id','desc');
    }

    public function articles (){
        return $this->hasMany(Article::class);
    }

    public function matchs(){
        return $this->belongsToMany(Match::class , 'match_team')->withPivot('status');
    }

    public function authUser(){
        return $this->belongsToMany(User::class,'team_user')->where('user_id','=',Auth::user()->id)->withPivot('status');;
    }
    public function joinRequests(){
        return $this->hasMany(TeamUser::class,'team_id')->where('status','=',0);
    }

    public function getSearchResult(): SearchResult
    {
        $url = url('teams/'.$this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
