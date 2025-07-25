<?php

namespace App\Services;

use GuzzleHttp\Client;

class TmdbService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function searchMovies($query, $page)
    {
        $response = $this->client->get("https://api.themoviedb.org/3/search/movie", [
            'headers' => [
                'Authorization' => 'Bearer ' . env('TMDB_BEARER_TOKEN'),
                'Content-Type' => 'application/json;charset=utf-8',
            ],
            'query' => [
                'query' => $query,
                'page' => $page,
                'language' => 'pt-BR',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function searchMoviesByTmdbId($id)
    {
        $response = $this->client->get("https://api.themoviedb.org/3/movie/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . env('TMDB_BEARER_TOKEN'),
                'Content-Type' => 'application/json;charset=utf-8',
            ],
            'query' => [
                'language' => 'pt-BR',
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
