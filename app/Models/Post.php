<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'author_id'];

    protected $appends = ['author_name'];

    protected $hidden = ['author'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getAuthorNameAttribute(): ?string
    {
        return $this->author?->name;
    }
}
