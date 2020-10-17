<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Leagues extends Model implements Searchable
{
      protected $fillable = [
        'name','description','image','created_at','status','updated_at','user_id',
    ];
  
   public function matches(){
        return $this->hasMany(Match::class,'League_id');
    }
      public function comments(){
        return $this->hasMany(Leagues_comments::class,'leagues_id');
    }
    public function getSearchResult(): SearchResult
    {
        $url = url('league-details/'.$this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
