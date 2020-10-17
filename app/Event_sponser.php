<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_sponser extends Model
{
    public $table = "event_sponsers";

    protected $fillable = [
        'event_id', 'sponser_id', 'status', 'created_at', 'updated_at'
    ];
}
