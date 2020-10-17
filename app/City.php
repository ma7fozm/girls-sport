<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable=[
        'name','status','govarea_id','created_at','updated_at'
    ];

}
