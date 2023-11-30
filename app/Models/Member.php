<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id'
    ];

    //Relación de uno a muchos a User y Room
    public function post(): BelongsTo
    {
        return $this->belongsTo(User::class);
        return $this->belongsTo(Room::class);
    }
}
