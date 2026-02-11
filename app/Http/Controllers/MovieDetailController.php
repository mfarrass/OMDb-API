<?php

namespace App\Http\Controllers;

use App\Services\OmdbService;
use Illuminate\Http\Request;

class MovieDetailController extends Controller
{
    private $omdb;

    public function __construct(OmdbService $omdb)
    {
        $this->omdb = $omdb;
    }

    public function index(Request $request)
    {
        $imdbID = $request->imdbID;

        if (!$imdbID) {
            return redirect('/');
        }

        $movie = $this->omdb->getMovieDetail($imdbID);

        if (!$movie) {
            abort(404);
        }

        return view('page.detail.index', compact('movie'));
    }

    public function loadMore(Request $request)
    {
        $search = $request->get('search', 'batman');
        $page   = $request->get('page', 1);

        $movies = $this->omdb->searchMovies($search, $page);

        return response()->json($movies);
    }


}
