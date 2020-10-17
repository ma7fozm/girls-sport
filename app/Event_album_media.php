<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_album_media extends Model
{
    protected $fillable = [
        'event_album_id','media_id','created_at','updated_at'
    ];
}
