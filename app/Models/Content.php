<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'content', 'category_id', 'url'];
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'content_genre', 'content_id', 'genre_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(
            Author::class,
            'author_content', // Pivot table name
            'content_id', // Foreign key on pivot table for this model
            'author_id'  // Foreign key on pivot table for the related model
        );
    }
}

