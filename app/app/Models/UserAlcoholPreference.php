<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAlcoholPreference extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'alcohol_type_id', 'preference'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function alcoholType()
    {
        return $this->belongsTo(AlcoholType::class, 'alcohol_type_id');
    }
}
