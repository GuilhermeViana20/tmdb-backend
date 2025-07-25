<?php

namespace App\Repositories;

use App\Models\Movie;

class MovieRepository
{
    public function all($genreId = null)
    {
        return Movie::with('genres')
            ->when($genreId, function ($query) use ($genreId) {
                $query->whereHas('genres', function ($q) use ($genreId) {
                    $q->where('genres.id', $genreId);
                });
            })
            ->get()
            ->map(function ($movie) {
                $movie->release_date = \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y');
                return $movie;
            });
    }

    public function find($id)
    {
        return Movie::find($id);
    }

    public function updateOrCreate($id, $data)
    {
        return Movie::updateOrCreate(['id' => $id], $data);
    }

    public function delete($id)
    {
        $movie = $this->find($id);
        if ($movie) {
            $movie->delete();
        }
    }
}
