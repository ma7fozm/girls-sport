<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News_comment extends Model
{
    //public $timestamps = false;

    protected $fillable = [
        'news_id', 'user_id', 'comment', 'status', 'parent', 'published_at'
    ];

    public function news()
    {
        return $this->belongsTo('App\News', 'new_id');
    }

    public function replies()
    {
        return $this->hasMany(News_comment::class, 'parent');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function added_by()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
