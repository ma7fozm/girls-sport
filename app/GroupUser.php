<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    public $table = "group_user";
    public $timestamps = false;
    protected $fillable = [
        'group_id', 'user_id','type'
    ];
}
