<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OmdbService;

class HomeController extends Controller
{
    private $omdb;

    public function __construct(OmdbService $omdb)
    {
        $this->omdb = $omdb;
    }

    public function index(Request $request)
    {
        $search = $request->get('search', 'batman');
        $page   = 1;

        $movies = $this->omdb->searchMovies($search, $page);
        $heroes = $this->omdb->getHeroMovies();

        return view('home', compact('movies', 'search', 'heroes'));
    }

    public function loadMore(Request $request)
    {
        $search = $request->get('search', 'batman');
        $page   = $request->get('page', 1);

        $movies = $this->omdb->searchMovies($search, $page);

        return response()->json($movies);
    }
}
