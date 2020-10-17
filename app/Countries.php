<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    public function user(){
       return $this->hasMany(User::class);
    }

    public function govareas(){
        return $this->hasMany(GovArea::class,'country_id');
    }


}
