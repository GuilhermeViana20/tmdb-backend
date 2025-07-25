<?php

namespace App\Services;

use App\Repositories\MovieRepository;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;

class MovieService
{
    protected $movieRepository;
    protected $tmdbService;

    public function __construct(MovieRepository $movieRepository, TmdbService $tmdbService)
    {
        $this->movieRepository = $movieRepository;
        $this->tmdbService = $tmdbService;
    }

    public function getAllMovies($genreId = null)
    {
        return $this->movieRepository->all($genreId);
    }

    public function getMovieById($id)
    {
        return $this->movieRepository->find($id);
    }

    public function storeMovie($id, $movieExternal)
    {
        $poster_prefix = 'https://image.tmdb.org/t/p/w300_and_h450_bestv2';

        $movie = $this->movieRepository->updateOrCreate($id, [
            'title' => $movieExternal['title'],
            'overview' => $movieExternal['overview'],
            'release_date' => $movieExternal['release_date'],
            'poster_path' => $poster_prefix . $movieExternal['poster_path']
        ]);

        $genreIds = [];
        foreach ($movieExternal['genres'] as $genre) {
            $genreModel = Genre::firstOrCreate([
                'id' => $genre['id'],
                'name' => $genre['name']
            ]);

            $genreIds[] = $genreModel->id;
        }

        $timestamp = now();
        $pivotData = array_fill_keys($genreIds, ['created_at' => $timestamp, 'updated_at' => $timestamp]);

        $movie->genres()->sync($pivotData);

        return $movie->load('genres');
    }

    public function deleteMovie($id)
    {
        $this->movieRepository->delete($id);
    }

    public function searchMovies($query, $page)
    {
        $moviesData = $this->tmdbService->searchMovies($query, $page);
        $tmdbIds = collect($moviesData['results'])->pluck('id')->toArray();
        $favoritedIds = DB::table('movies')->whereIn('id', $tmdbIds)->pluck('id')->toArray();
        $movies = collect($moviesData['results'])->map(function ($movie) use ($favoritedIds) {
            return [
                'id'           => $movie['id'],
                'title'        => $movie['title'],
                'overview'     => $movie['overview'],
                'poster_path'  => 'https://image.tmdb.org/t/p/w300_and_h450_bestv2' . $movie['poster_path'],
                'release_date' => !empty($movie['release_date']) ? date('d/m/Y', strtotime($movie['release_date'])) : null,
                'favorited'    => in_array($movie['id'], $favoritedIds),
            ];
        });
        return [
            'current_page' => (int) $page,
            'last_page'    => $moviesData['total_pages'],
            'total'        => $moviesData['total_results'],
            'movies'       => $movies->values(),
        ];
    }
}
