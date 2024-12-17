<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookCategory extends Model
{
    use HasFactory;

    protected $guarded = [];  // Allow all attributes to be mass-assigned

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}
