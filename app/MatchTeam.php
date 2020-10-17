<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchTeam extends Model
{
    public $table = "match_team";
    public $timestamps = false;
    protected $fillable = [
        'team_id', 'match_id'
    ];

}
