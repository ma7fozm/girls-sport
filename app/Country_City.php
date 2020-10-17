<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country_City extends Model
{
    protected $table = 'country_city';
    protected $fillable=[
      'id','parent_id','english','arabic','latitude','longitude','left','right','chart_color'
    ];
}
