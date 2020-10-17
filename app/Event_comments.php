<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_comments extends Model
{
    protected $table = 'event_comments';

    protected $fillable = [
        'event_id','comment','parent','user_id','status','created_at','updated_at'
    ];

    public function added_by(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function replies(){
        return $this->hasMany(event_comments::class,'parent');
    }

    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }
}
