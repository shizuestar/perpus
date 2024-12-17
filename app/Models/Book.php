<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $guarded = [];  // Allow all attributes to be mass-assigned

    public static function boot()
    {
        parent::boot();

        // Generate slug automatically when creating or updating
        static::creating(function ($book) {
            $book->slug = Str::slug($book->title);
        });

        static::updating(function ($book) {
            $book->slug = Str::slug($book->title);
        });
    }

    public function bookReviews(): HasMany
    {
        return $this->hasMany(BookReview::class);
    }

    public function personalCollections(): HasMany
    {
        return $this->hasMany(PersonalCollection::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BookCategory::class);
    }
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'book_id');
    }
}