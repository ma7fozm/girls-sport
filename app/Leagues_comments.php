<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leagues_comments extends Model
{
    protected $table = 'league_comments';

    protected $fillable = [
        'leagues_id','comment','parent','user_id','status','created_at','updated_at'
    ];

    public function added_by(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function replies(){
        return $this->hasMany(Leagues_comments::class,'parent');
    }
     public function league(){
        return $this->belongsTo(Leagues::class,'leagues_id');
    }
}
