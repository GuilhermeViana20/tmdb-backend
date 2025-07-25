<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use App\Services\TmdbService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $movieService;
    protected $tmdbService;

    public function __construct(MovieService $movieService, TmdbService $tmdbService)
    {
        $this->movieService = $movieService;
        $this->tmdbService = $tmdbService;
    }

    public function index(Request $request)
    {
        $genreId = $request->query('genre_id');
        $movies = $this->movieService->getAllMovies($genreId);
        return response()->json($movies);
    }

    public function show($id)
    {
        $movie = $this->movieService->getMovieById($id);

        if (!$movie) {
            return response()->json(['message' => 'Filme não encontrado'], 404);
        }

        return response()->json([
            'id'           => $movie['id'],
            'title'        => $movie['title'],
            'overview'     => $movie['overview'],
            'release_date' => date('d/m/Y', strtotime($movie['release_date'])),
            'poster_path'  => $movie['poster_path'],
        ]);
    }

    public function store($id)
    {
        $movieExternal = $this->tmdbService->searchMoviesByTmdbId($id);
        $movie = $this->movieService->storeMovie($id, $movieExternal);
        return response()->json($movie);
    }

    public function destroy($id)
    {
        $this->movieService->deleteMovie($id);
        return response()->json(['message' => 'Filme removido com sucesso.']);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
            'page'  => 'nullable|integer|min:1',
        ]);

        $query = $request->input('query');
        $page  = $request->input('page', 1);

        $searchResults = $this->movieService->searchMovies($query, $page);

        return response()->json($searchResults);
    }
}
