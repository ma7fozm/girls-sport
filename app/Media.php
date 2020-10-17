<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Media extends Model implements Searchable
{
    protected $fillable = [
        'name', 'type', 'media_type', 'public', 'media_link', 'user_id', 'status', 'description', 'title', 'added_by', 'team_id', 'group_id', 'created_at', 'updated_at'
    ];

    public function added_user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function album()
    {
        return $this->belongsToMany(Event_album::class, 'event_album_media');
    }

    public function comments()
    {
        return $this->hasMany(Media_comments::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('gallary-details', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}

