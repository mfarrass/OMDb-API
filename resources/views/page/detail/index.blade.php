@extends('layouts.main')
@section('title', __('messages.movie_detail'))
@section('navbarTitle', __('messages.movie_detail'))
@section('content')

    @push('styles')
        <style>
            .movie-detail-layout {
                display: flex;
                gap: 40px;
                align-items: flex-start;
            }

            .movie-video {
                flex: 0 0 520px;
            }

            .movie-video img {
                width: 100%;
                max-width: 500px;
                aspect-ratio: 2 / 3;
                object-fit: cover;
                border-radius: 16px;
            }

            .movie-video iframe {
                width: 100%;
                height: 420px;
                border-radius: 12px;
            }

            .movie-detail-info {
                flex: 1;
            }

            .movie-detail-info .item-content-title {
                font-size: 2.5rem;
                line-height: 3rem;
                font-weight: 800;
            }

            .movie-detail-info .movie-infos {
                margin-top: 10px;
                gap: 15px;
            }

            .movie-detail-info .movie-info {
                font-size: 0.9rem;
            }

            .movie-detail-info .item-content-description {
                margin-top: 20px;
                font-size: 1rem;
                color: #cfcfcf;
                line-height: 1.6;
            }

            .movie-detail-info .btn {
                margin-top: 10px;
            }

            main {
                display: flex;
                flex-direction: column;
            }

            .section {
                flex: 1;
            }

            @media (max-width: 900px) {
                .movie-detail-layout {
                    flex-direction: column;
                }

                .movie-video iframe {
                    height: 250px;
                }

                .movie-detail-info .item-content-title {
                    font-size: 2rem;
                }
            }
        </style>
    @endpush


    @include('components.navbar')

    <main>
        <div class="section">
            <div class="container">

                <!-- ✅ LOCALIZED HEADER -->
                <div class="section-header">
                    {{ __('messages.movie_detail') }}
                </div>

                <div class="movie-detail-layout">

                    <!-- POSTER -->
                    <div class="movie-video">
                        <img src="{{ $movie['PosterHD'] }}"
                            class="{{ str_contains($movie['PosterHD'], 'dummy=1') ? 'poster-dummy' : '' }}" loading="lazy">
                    </div>

                    <!-- INFO -->
                    <div class="movie-detail-info">

                        <div class="item-content-title">
                            {{ $movie['Title'] }}
                        </div>

                        <!-- OMDb DATA (NO TRANSLATE ✔) -->
                        <div class="movie-infos">
                            <div class="movie-info">⭐ {{ $movie['imdbRating'] }}</div>
                            <div class="movie-info">⏱ {{ $movie['Runtime'] }}</div>
                            <div class="movie-info">{{ $movie['Year'] }}</div>
                            <div class="movie-info">{{ $movie['Rated'] ?? 'PG-13' }}</div>
                        </div>

                        <div class="item-content-description">
                            {{ $movie['Plot'] }}
                        </div>

                        <!-- FAVORITE BUTTON -->
                        <div
                            style="
                                    margin-top: 30px;
                                    display: flex;
                                    gap: 15px;
                                    flex-wrap: wrap;
                                ">

                            <form method="POST" action="{{ route('favorite.toggle') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}">

                                <button type="submit" class="btn btn-hover">
                                    <i class="bx bx-heart"></i>

                                    <span>
                                        {{ session('favorites')[$movie['imdbID']] ?? false
                                            ? __('messages.remove_favorite')
                                            : __('messages.add_favorite') }}
                                    </span>

                                </button>
                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('components.footer')

@endsection
