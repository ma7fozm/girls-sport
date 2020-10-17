<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    protected $fillable = [
        'name', 'description','created_at','status','updated_at','sport_id','team_id','image_url','user_id','admin_id','status'
    ];

    public function added_by(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function authUser(){
        return $this->belongsToMany(User::class,'group_user')->where('user_id','=',Auth::user()->id)->withPivot('status');
    }

    public function groupAdmin(){
        return $this->belongsTo(User::class,'admin_id');
    }

    public function sport(){
        return $this->belongsTo(Sport::class);
    }

    public function medias(){
        return $this->hasMany(Media::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function users(){
        return $this->belongsToMany(User::class , 'group_user')->withPivot('status');
    }

    public function articlesPag (){
        return $this->hasMany(Article::class)->paginate(1);
    }

    public function articles (){
        return $this->hasMany(Article::class)->orderBy('id','desc');
    }

    public function joinRequests(){
        return $this->hasMany(GroupUser::class,'group_id')->where('status','=',0);
    }

}
