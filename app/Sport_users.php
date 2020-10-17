<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport_users extends Model
{
    protected $table = 'sport_user';
    protected $fillable = [
        'sport_id', 'user_id','status','type','created_at','updated_at'
    ];
}
