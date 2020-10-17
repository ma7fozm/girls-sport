<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class News extends Model implements Searchable
{
    protected $fillable = [
        'title','intro','content','image','status','created_at','updated_at','category_id','user_id','news_type'
    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function comments(){
        return $this->hasMany(News_comment::class)->orderBy('id','desc');;
    }

      public function user(){
        return $this->belongsTo(User::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = url('news/'.$this->id);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}
