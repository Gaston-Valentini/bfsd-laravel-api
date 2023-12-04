<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'nickname',
        "email",
        "password",
        "image"
    ];

    protected $hidden = [
        "password"

    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class);
    }

    public function creator_room(): HasMany
    {
        return $this->hasMany(Room::class);
    }


    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
