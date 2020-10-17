<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'intro', 'content', 'image', 'status', 'created_at', 'updated_at', 'category_id', 'user_id', 'group_id', 'team_id', 'superadmin_id', 'article_type', 'public'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Articles_comments::class);
    }

    public function added_by_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function added_by_admin()
    {
        return $this->belongsTo(User::class, 'superadmin_id');
    }


}
