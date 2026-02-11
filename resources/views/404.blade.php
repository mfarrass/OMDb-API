@extends('layouts.main')
@section('title', 'Login')
@section('navbarTitle', 'Login')
@section('content')

    @push('styles')
        <style>
            .page-404 {
                height: 85vh;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                flex-direction: column;
            }

            .text-404 {
                font-size: 140px;
                font-weight: 900;
                color: var(--main-color);
                letter-spacing: 8px;
            }

            .text-desc {
                font-size: 22px;
                margin-top: 10px;
                opacity: .8;
            }

            .back-home {
                margin-top: 40px;
            }

            .text-404 {
                text-shadow:
                    0 0 10px rgba(192, 57, 43, .6),
                    0 0 30px rgba(192, 57, 43, .4);
            }

            @media (max-width:768px){
                .text-404 {
                    font-size: 95px;
                }

                .text-desc {
                    font-size: 14px;
                }
            }

        </style>
    @endpush

    @include('components.navbar')
    <!-- 404 CONTENT -->
    <div class="page-404">

        <div class="text-404">
            404
        </div>

        <div class="text-desc">
            {{ __('messages.page_not_found') }}
        </div>

        <div class="back-home">
            <a href="{{ route('home') }}" class="btn btn-hover">
                <i class='bx bx-home'></i>
                <span>{{ __('messages.back') }}</span>
            </a>
        </div>

    </div>
    @include('components.footer')

@endsection
