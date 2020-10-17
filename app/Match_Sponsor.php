<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match_Sponsor extends Model
{
    public $table = "match_sponsers";

    protected $fillable = [
        'match_id', 'sponser_id', 'status', 'created_at', 'updated_at'
    ];
}
