<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'overview',
        'release_date',
        'poster_path',
        'created_at',
        'updated_at',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
