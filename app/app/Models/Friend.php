<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = ['user_id', 'friend_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
