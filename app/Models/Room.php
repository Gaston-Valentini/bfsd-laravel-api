<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'name',
        'image_url',
        'is_active'
    ];
    
    //Relación uno a muchos a la tabla a Message y Member
    public function comments(): HasMany
    {
        return $this->hasMany(Message::class);
        return $this->hasMany(Member::class);

    }

    //Relacion muchos a uno a la tabla Game
    public function post(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    //Relación muchos a muchos con la tabla User
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
