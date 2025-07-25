<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreMovie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'movie_id',
        'genre_id',
        'created_at',
        'updated_at',
    ];
}
