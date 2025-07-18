<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url'];

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class,  'author_content', 'author_id', 'content_id');
    }
}
