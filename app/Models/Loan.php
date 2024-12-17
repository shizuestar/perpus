<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public static function checkRequestUser(User $user, Book $book)
    {
        return self::where('user_id', $user->id)
        ->where('book_id', $book->id)
        ->whereIn('status', ['disetujui', 'proses'])
        ->exists();
    }
}
