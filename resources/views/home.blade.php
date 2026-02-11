@extends('layouts.main')
@section('title', 'Home')
@section('navbarTitle', 'Home')
@section('content')

    @include('components.navbar')

    <!-- HERO SECTION -->
    <div class="hero-section">
        <div class="hero-slide">
            <div class="owl-carousel carousel-nav-center" id="hero-carousel">

                @foreach ($heroes as $hero)
                    <div class="hero-slide-item" style="background-image:url('{{ $hero['PosterHD'] }}');">

                        <div class="overlay"></div>

                        <div class="hero-slide-item-content">
                            <div class="item-content-wraper">

                                <div class="item-content-title top-down">
                                    {{ $hero['Title'] }}
                                </div>

                                <div class="movie-infos top-down delay-2">
                                    <div class="movie-info">
                                        <i class="bx bxs-star"></i>
                                        <span>{{ $hero['imdbRating'] ?? 'N/A' }}</span>
                                    </div>

                                    <div class="movie-info">
                                        <i class="bx bxs-time"></i>
                                        <span>{{ $hero['Runtime'] ?? 'N/A' }}</span>
                                    </div>

                                    <div class="movie-info">
                                        <span>HD</span>
                                    </div>

                                    <div class="movie-info">
                                        <span>{{ $hero['Rated'] ?? 'PG-13' }}</span>
                                    </div>
                                </div>

                                <div class="item-content-description top-down delay-4">
                                    {{ \Illuminate\Support\Str::limit($hero['Plot'], 200) }}
                                </div>

                                <div class="item-action top-down delay-6">
                                    <a href="/movie-detail?imdbID={{ $hero['imdbID'] }}" class="btn btn-hover">
                                        <i class="bx bx-show"></i>
                                        <span>{{ __('messages.see_detail') }}</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- END HERO -->



    <!-- MOVIE LIST SECTION -->
    <div class="section">
        <div class="container">

            <!-- SECTION HEADER -->
            <div class="section-header">
                {{ __('messages.search_movies') }}
            </div>

            <!-- SEARCH FORM -->
            <form method="GET" action="/">
                <div class="search-box">
                    <div class="search-container">

                        <input type="text"
                               name="search"
                               value="{{ $search }}"
                               placeholder="{{ __('messages.search_placeholder') }}"
                               class="search-input">

                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>

                        <input type="hidden" id="current-page" value="1">
                        <input type="hidden" id="current-search" value="{{ $search }}">

                    </div>
                </div>
            </form>


            <!-- MOVIE LIST -->
            <div class="row" id="movie-list">

                @if (empty($movies))

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            noMoreMovies = true;
                        });
                    </script>

                    <div class="empty-wrapper">
                        <div class="empty-favorite">

                            <i class='bx bx-camera-movie'></i>

                            <h2>{{ __('messages.no_movies') }}</h2>

                            <p>
                                {{ __('messages.try_keyword') }}
                            </p>

                        </div>
                    </div>

                @endif


                @foreach ($movies as $movie)
                    <div class="col-3 movie-card">
                        <a href="/movie-detail?imdbID={{ $movie['imdbID'] }}" class="movie-item">

                            <img src="{{ $movie['PosterHD'] }}"
                                 loading="lazy"
                                 onerror="this.onerror=null;this.src='https://dummyimage.com/600x900/111/fff&text=No+Image';"
                                 class="movie-poster">

                            <div class="movie-item-content">
                                <div class="movie-item-title">
                                    {{ $movie['Title'] }}
                                </div>

                                <div class="movie-infos">
                                    <div class="movie-info">
                                        {{ $movie['Year'] }}
                                    </div>
                                    <div class="movie-info">
                                        {{ $movie['Type'] }}
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div>
                @endforeach

            </div>


            <!-- LOADER -->
            <div id="scroll-loader">
                <div class="loader-spinner"></div>
                <span>{{ __('messages.loading_movies') }}</span>
            </div>

        </div>
    </div>

    @include('components.footer')

@endsection
