@extends('layouts.main')
@section('title', 'Login')
@section('navbarTitle', 'Login')
@section('content')

    @push('styles')
        <style>
            .login-page {
                height: 80vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .login-box {
                width: 420px;
                padding: 50px;
                background: rgba(34, 31, 31, .95);
                border-radius: 12px;
                box-shadow:
                    0 0 20px rgba(255, 255, 255, 0.327),
                    0 0 60px rgba(0, 0, 0, .6);
            }

            .login-title {
                font-size: 32px;
                font-weight: 800;
                text-align: center;
                /* margin-bottom:30px; */
            }

            .login-input {
                width: 100%;
                padding: 14px;
                margin-bottom: 20px;
                border: none;
                border-radius: 6px;
                background: #2c2c2c;
                color: white;
                font-size: 16px;
                outline: none;
                transition: .3s;
            }

            .login-input:focus {
                border: 1px solid var(--main-color);
                box-shadow: 0 0 10px rgba(192, 57, 43, .5);
            }

            .login-btn {
                width: 100%;
                justify-content: center;
                padding: 14px;
                font-size: 18px;
            }

            body {
                background:
                    linear-gradient(rgba(0, 0, 0, .85), rgba(0, 0, 0, .95)),
                    url('{{ asset('template/images/transformer-banner.jpg') }}');
                background-size: cover;
                background-position: center;
            }
        </style>
    @endpush

    @include('components.navbar')
    <div class="login-page">

        <div class="login-box">
            <div class="login-title">
                <a href="#" class="logo">
                    <i class='bx bxs-camera-movie bx-tada main-color'></i>Article <span class="main-color">F</span>ilm
                </a>
            </div>

            <form method="POST" action="/login">
                {{ csrf_field() }}
                @if(session('error'))
                    <div style="color:red; margin-bottom:15px;">
                        {{ session('error') }}
                    </div>
                @endif
                <input 
                    type="text"
                    name="username"
                    placeholder="Username"
                    class="login-input"
                    required
                >

                <input 
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="login-input"
                    required
                >


                <button type="submit" class="btn btn-hover login-btn">
                    <i class='bx bx-log-in'></i>
                    <span>Login</span>
                </button>

            </form>

        </div>

    </div>
    @include('components.footer')

@endsection
