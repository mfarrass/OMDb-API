@extends('layouts.main')

@section('title', __('messages.favorite_title'))
@section('navbarTitle', __('messages.favorite_title'))

@section('content')

    @push('styles')
        <style>
            .delete-btn {
                position: absolute;
                top: 1px;
                width: 38px;
                height: 38px;
                border-radius: 5%;
                border: 2px solid white;
                background: var(--main-color);
                color: white;
                font-size: 18px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10;
                transition: .25s;
                backdrop-filter: blur(6px);
            }

            .delete-btn:hover {
                background: #e74c3c;
                transform: scale(1.1);
            }

            .movie-card {
                position: relative;
                transition: .25s;
            }

            .movie-card:hover {
                transform: translateY(-6px);
            }

            .main-content {
                flex: 1;
            }
        </style>
    @endpush


    @include('components.navbar')

    <main class="main-content">

        <div class="section" style="margin:15px;">
            <div class="container">
                <div class="section-header">
                    {{ __('messages.favorite_title') }}
                </div>

                @if (count($favorites) > 0)

                    <div class="favorite-grid">

                        @foreach ($favorites as $fav)
                            <div class="movie-card">

                                <form method="POST" action="{{ route('favorite.toggle') }}">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="imdbID" value="{{ $fav['imdbID'] ?? '' }}">

                                    <button class="delete-btn">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>

                                <!-- MOVIE CARD -->
                                <a href="/movie-detail?imdbID={{ $fav['imdbID'] }}" class="movie-item">

                                    <img src="{{ $fav['Poster'] ?? 'https://dummyimage.com/600x900/111/fff&text=No+Image' }}"
                                        onerror="this.onerror=null;this.src='https://dummyimage.com/600x900/111/fff&text=No+Image';"
                                        loading="lazy">

                                    <div class="movie-item-content">
                                        <div class="movie-item-title">
                                            {{ $fav['Title'] }}
                                        </div>
                                    </div>

                                </a>

                            </div>
                        @endforeach

                    </div>

                    {{-- ============================= --}}
                    {{-- EMPTY FAVORITES --}}
                    {{-- ============================= --}}
                @else
                    <div class="empty-wrapper">
                        <div class="empty-favorite">

                            <i class='bx bx-heart'></i>

                            <h2>
                                {{ __('messages.no_favorite') }}
                            </h2>

                            <p>
                                {{ __('messages.try_keyword') }}
                            </p>

                            <a href="/" class="btn btn-hover">
                                <span>{{ __('messages.browse_movies') }}</span>
                            </a>

                        </div>
                    </div>

                @endif

            </div>
        </div>

    </main>

    @include('components.footer')

@endsection
