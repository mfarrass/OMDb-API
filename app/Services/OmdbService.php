<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class OmdbService
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->apiKey  = config('services.omdb.key');
        $this->baseUrl = config('services.omdb.url');
    }

    /**
     * SEARCH MOVIE
     */
    public function searchMovies($query = 'batman', $page = 1)
    {
        $url = $this->baseUrl . '?apikey=' . $this->apiKey .
            '&s=' . urlencode($query) .
            '&page=' . $page;

        $response = @file_get_contents($url);

        if (!$response) {
            return [];
        }

        $data = json_decode($response, true);
        $movies = $data['Search'] ?? [];

        // ⭐ inject PosterHD automatically
        foreach ($movies as &$movie) {
            $movie['PosterHD'] = $this->poster(
                $movie['Poster'],
                1000,
                600,
                900
            );
        }

        return $movies;
    }


    /**
     * GET MOVIE DETAIL
     */
    public function getMovieDetail($imdbID)
    {
        return Cache::remember("movie_v2_{$imdbID}", 3600, function () use ($imdbID) {

            $url = $this->baseUrl . '?apikey=' . $this->apiKey .
                '&i=' . $imdbID .
                '&plot=full';

            $response = @file_get_contents($url);

            if (!$response) return null;

            $movie = json_decode($response, true);

            $movie['PosterHD'] = $this->poster(
                $movie['Poster'],
                1000,
                1800,
                585
            );

            return $movie;
        });
    }

    public function getHeroMovies()
    {
        return Cache::remember('hero_movies', 3600, function () {

            $heroesConfig = [

                [
                    'title' => 'Black Panther',
                    'banner' => asset('template/images/black-banner.png')
                ],

                [
                    'title' => 'Supergirl',
                    'banner' => asset('template/images/supergirl-banner.jpg')
                ],

                [
                    'title' => 'WandaVision',
                    'banner' => asset('template/images/wanda-banner.jpg')
                ],

            ];

            $heroes = [];

            foreach ($heroesConfig as $config) {

                $url = $this->baseUrl . '?apikey=' . $this->apiKey .
                    '&t=' . urlencode($config['title']) .
                    '&plot=short';

                $response = @file_get_contents($url);

                if (!$response) continue;

                $movie = json_decode($response, true);

                if (!isset($movie['imdbID'])) continue;

                // 🔥 pakai banner static
                $movie['PosterHD'] = $config['banner'];

                $heroes[] = $movie;
            }

            return $heroes;
        });
    }




    public function poster($url, $size = 700, $dummyWidth = 600, $dummyHeight = 900)
    {
        $dummy = "https://dummyimage.com/{$dummyWidth}x{$dummyHeight}/111/fff&text=No+Image";

        if (empty($url) || $url === 'N/A') {
            return $dummy;
        }

        $url = preg_replace('/SX\d+/', "SX{$size}", $url);

        if (!@getimagesize($url)) {
            return $dummy;
        }

        return $url;
    }



}
