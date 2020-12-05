<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Content Share - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="wrapper">
            <div class="header__left">
                <a class="header__left-logo" href="/">Content Share</a>
                <a href="">Upload</a>
            </div>
            <div class="header__right">
                @guest
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @else
                    
                    <div class="dropdown">
                        <div class="dropdown__toggle">
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <div class="dropdown__content">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </header>
    @yield('content')
    <div class="notifications">
        @if($errors->any())
            <span class="msg error">
                <strong>{{ $message }}</strong>
                <i class="fas fa-times msg__close-btn" onclick="this.parentElement.style.display='none';"></i>
            </span>
        @endif
</div>
</body>
</html>