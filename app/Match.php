<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class Match extends Model implements Searchable
{
    protected $fillable = [
        'title','description','image','status','place_id','user_id','result','created_at','updated_at','start_time','end_time','date','match_type','league_id'
    ];

    public function teams(){
        return $this->belongsToMany(Team::class , 'match_team');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'match_user');
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

    public function added_by(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function sponsors(){
        return $this->belongsToMany(Sponser::class, 'match_sponsers');
    }

    public function comments(){
        return $this->hasMany(Matches_comments::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = url('match-details/'.$this->id);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}
