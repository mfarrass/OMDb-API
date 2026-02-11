<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OmdbService;

class FavoriteController extends Controller
{
    private $omdb;

    public function __construct(OmdbService $omdb)
    {
        $this->omdb = $omdb;
    }

    public function index()
    {
        $favorites = session('favorites', []);

        return view('page.favorite.index', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $imdbID = $request->imdbID;

        $favorites = session('favorites', []);

        if(isset($favorites[$imdbID])){
            unset($favorites[$imdbID]);
        }else{
            $movie = $this->omdb->getMovieDetail($imdbID);

            $favorites[$imdbID] = [
                'imdbID' => $movie['imdbID'],
                'Title'  => $movie['Title'],
                'Poster' => $this->omdb->poster(
                    $movie['Poster'],
                    700,
                    500,
                    750
                ),
                'Year'   => $movie['Year']
            ];
        }

        session(['favorites'=>$favorites]);

        return back();
    }
}
