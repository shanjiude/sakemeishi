<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteDrink extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'image_url', 'product_url'];
}
