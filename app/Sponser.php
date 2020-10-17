<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponser extends Model
{
    protected $fillable = [
         'name', 'created_at','status','updated_at','user_id','image',
    ];}
