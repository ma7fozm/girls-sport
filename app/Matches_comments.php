<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matches_comments extends Model
{
    protected $table = 'match_comments';

    protected $fillable = [
        'match_id','comment','parent','user_id','status','created_at','updated_at'
    ];

    public function added_by(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function replies(){
        return $this->hasMany(Matches_comments::class,'parent');
    }

    public function match(){
        return $this->belongsTo(Match::class,'match_id');
    }
}
