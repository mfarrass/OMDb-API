<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@authenticate');
Route::get('/logout', 'AuthController@logout')->name('logout');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth.session']], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/movies/load', 'HomeController@loadMore')
    ->name('movies.load');

    Route::get('/movie-detail', 'MovieDetailController@index');

    Route::get('/favorite-movie', 'FavoriteController@index');

    Route::post('/favorite/toggle', 'FavoriteController@toggle')
        ->name('favorite.toggle');
});


/*
|--------------------------------------------------------------------------
| 404 FALLBACK
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()
        ->view('404', [], 404);
});

/*
|--------------------------------------------------------------------------
| SET LOCALE LANGUAGE
|--------------------------------------------------------------------------
*/
Route::get('/lang/{locale}', function ($locale) {

    abort_unless(in_array($locale, ['en','id']), 400);

    session(['locale'=>$locale]);

    return redirect()->back();

})->name('lang.switch');


Route::get('/session-test', function(){
    session(['test'=>'ok']);
    return session('test');
});
