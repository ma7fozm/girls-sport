<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_user extends Model
{
    protected $fillable = [
        'user_id','event_id','status','created_at','updated_at'
    ];

}
