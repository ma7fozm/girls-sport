<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function news(){
        return $this->hasMany(News::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }
    public $table = "categories";

    protected $fillable = [
        'name', 'created_at','status','updated_at','user_id',
    ];
}
