<?php

namespace App\Services;

use App\Repositories\GenreRepository;

class GenreService
{
    protected $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function getAllGenres()
    {
        return $this->genreRepository->all();
    }
}
