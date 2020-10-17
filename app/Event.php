<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class Event extends Model implements Searchable
{
	protected $fillable = [
        'name','place_id','team_id','group_id','public','event_type','num_of_attendees','from_datetime','to_datetime','agenda','status','created_at','updated_at','user_id'
    ];
     public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team');
    }

    public function sponsors(){
        return $this->belongsToMany(Sponser::class, 'event_sponsers');
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

    public function added_by(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments(){
        return $this->hasMany(Event_comments::class)->orderBy('id','desc');
    }

    public function albums(){
        return $this->hasMany(Event_album::class);
    }

    public function users(){
         return $this->belongsToMany(User::class,'event_users');
    }

    public function authUser(){
        return $this->belongsToMany(User::class,'event_users')->where('user_id','=',Auth::user()->id)->withPivot('status');;
    }

    public function joinRequests(){
        return $this->hasMany(Event_user::class,'event_id')->where('status','=',0);
    }

    public function eventAdmin(){
         return $this->belongsTo(User::class , 'user_id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = url('events/'.$this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
