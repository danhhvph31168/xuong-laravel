<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Articles extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content'
    ];
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    // public function ratings()
    // {
    //     return $this->morphMany(Rating::class, 'ratingable');
    // }

    public function ratings()
    {
        return $this->morphToMany(Rating::class, 'ratinggable');
    }
}
