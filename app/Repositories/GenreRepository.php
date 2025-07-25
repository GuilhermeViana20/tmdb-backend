<?php

namespace App\Repositories;

use App\Models\Genre;

class GenreRepository
{
    public function all()
    {
        return Genre::orderBy('name')->get();
    }
}
