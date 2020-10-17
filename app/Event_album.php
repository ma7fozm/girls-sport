<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_album extends Model
{
    protected $fillable = [
        'name','status','event_id','created_at','updated_at'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function medias(){
        return $this->belongsToMany(Media::class,'event_album_media');
    }
}
