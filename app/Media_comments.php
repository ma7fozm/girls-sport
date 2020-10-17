<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media_comments extends Model
{
     protected $table = 'media_comments';

    protected $fillable = [
        'media_id','comment','parent','user_id','status','created_at','updated_at'
    ];

    public function added_by(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function replies(){
        return $this->hasMany(Media_comments::class,'parent');
    }

    public function media(){
        return $this->belongsTo(Media::class,'media_id');
    }

}
