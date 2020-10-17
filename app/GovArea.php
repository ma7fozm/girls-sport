<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GovArea extends Model
{
    protected $table = 'govareas';
    protected $fillable=[
      'name','status','country_id','created_at','updated_at'
    ];

    public function cities(){
        return $this->hasMany(City::class,'govarea_id');
    }
}

