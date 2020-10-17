<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    public $timestamps = false;
    public $table = "team_user";
    protected $fillable = [
        'team_id', 'user_id','status'
    ];
}
