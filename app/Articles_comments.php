<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles_comments extends Model
{
    protected $table = 'articles_comments';

    protected $fillable = [
        'article_id','comment','parent','user_id','status','created_at','updated_at'
    ];

    public function added_by(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function replies(){
        return $this->hasMany(Articles_comments::class,'parent');
    }

    public function article(){
        return $this->belongsTo(Article::class,'article_id');
    }
}
