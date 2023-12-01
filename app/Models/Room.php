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



    //Relación muchos a muchos con la tabla User
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}


