<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchUser extends Model
{
    public $table = "match_user";
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'match_id'
    ];
}
