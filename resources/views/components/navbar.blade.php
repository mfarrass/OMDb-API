<!-- NAV -->
<div class="nav-wrapper">
    <div class="container">
        <div class="nav">
            <a href="{{ session('logged_in') ? route('home') : '#' }}" class="logo">
                <i class='bx bxs-camera-movie bx-tada main-color'></i>
                Article <span class="main-color">F</span>ilm
            </a>

            <ul class="nav-menu" id="nav-menu">

                 @if(session()->has('logged_in'))
                <li>
                    <a href="/favorite-movie" class="favorite-icon">
                        <i class='bx bxs-heart'></i> {{ __('messages.favorites') }}
                    </a>
                </li>
                @endif
                <!-- 🌐 LANGUAGE DROPDOWN -->
                <li class="lang-dropdown">
                    <div class="lang-selected" id="selected-lang">
                        @php
                        $langs = [
                            'en' => [
                                'flag' => 'https://flagcdn.com/w20/us.png',
                                'label' => 'EN'
                            ],
                            'id' => [
                                'flag' => 'https://flagcdn.com/w20/id.png',
                                'label' => 'ID'
                            ]
                        ];
                        @endphp
                            <img src="{{ $langs[app()->getLocale()]['flag'] }}">
                            <span>{{ $langs[app()->getLocale()]['label'] }}</span>
                            <i class='bx bx-chevron-down'></i>
                    </div>

                    <div class="lang-menu">
                        <a href="{{ route('lang.switch', 'en') }}">
                            <img src="https://flagcdn.com/w20/us.png">
                            English
                        </a>

                        <a href="{{ route('lang.switch', 'id') }}">
                            <img src="https://flagcdn.com/w20/id.png">
                            Indonesia
                        </a>
                    </div>
                </li>

                <li>
                    @if(session()->has('logged_in'))
                        <a href="/logout" class="btn btn-hover">
                            <span>{{ __('messages.logout') }}</span>
                        </a>
                    @else
                        <a href="/login" class="btn btn-hover">
                            <span>{{ __('messages.signin') }}</span>
                        </a>
                    @endif
                </li>
            </ul>

            <!-- MOBILE MENU -->
            <div class="hamburger-menu" id="hamburger-menu">
                <div class="hamburger"></div>
            </div>
        </div>
    </div>
</div>
<!-- END NAV -->
