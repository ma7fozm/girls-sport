<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class Place extends Model  implements Searchable
{
     protected $fillable = [
        'name','address','image','status','created_at','updated_at','user_id'
    ];

     public function events(){
        return $this->hasMany(Event::class);
    }

  	public function matches(){
        return $this->hasMany(Match::class);
    }

      public function added_by(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = url('places');

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
