<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'title','content','user_id','superadmin_id','event_id','match_id','parent','image','status','created_at','updated_at'
    ];

    public function event(){
        return $this->belongsTo(Event::class , 'event_id');
    }

    public function match(){
        return $this->belongsTo(Match::class , 'match_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Message::class,'parent')->where('status','=',1);
    }
}
