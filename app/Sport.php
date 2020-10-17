<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Sport extends Model implements Searchable
{
    protected $fillable = [
        'name','description','type','status','image','user_id','created_at','updated_at'
    ];

    public function groups(){
        return $this->hasMany(Group::class)->where('status','=',1)->orderBy('id','desc');
    }

    public function teams(){
        return $this->hasMany(Team::class);
    }

    public function members(){
        return $this->belongsToMany(User::class,'sport_user')->orderBy('id','desc');
    }

    public function getSearchResult(): SearchResult
    {
        $url = url('sports/'.$this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
