<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $guarded = [];  // Allow all attributes to be mass-assigned

    public function bookReviews(): HasMany
    {
        return $this->hasMany(BookReview::class, 'user_id');
    }

    public function personalCollections() : HasMany {
        return $this->hasMany(PersonalCollection::class, "user_id");
    }
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'user_id');
    }
}
