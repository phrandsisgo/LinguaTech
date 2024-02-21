<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>linguaTech-@yield('title')</title>
    
    @vite(['resources/css/main.scss', 'resources/js/app.js'])
    @yield('head')
</head>
<body>
<nav>
   <div class="nav-wrapper">
    <a href="/library" class="iconWrapper">
        <img src="{{ asset('svg-icons/home-icon.svg')}}" alt="home Icon" class="icons">
    </a>
        <div class="horizontal-fill"></div>
        <p id="navText">LinguaTech</p>
        <div class="horizontal-fill"></div>

        @if (auth()->check())
            <a href="/about_project" class="iconWrapper">
                <img src="{{ asset('svg-icons/info-icon.svg')}}" alt="impressum Icon" class="icons des-only">
            </a>
            <a href="/library" class="iconWrapper">
                <img src="{{ asset('svg-icons/library-icon.svg')}}" alt="library Icon" class="icons navIcons des-only">
            </a>
        @else       
        <a href="/login" class="NavFont">Login</a>
        @endif
        <!-- <img src="{{ asset('svg-svg-icons/menu-icon.svg')}}" alt="menu Icon" class="navIcons">
         -->
         <div class="btn-group">
            <button type="button" class="btn menuBtn" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('svg-icons/menu-icon.svg')}}" alt="menu Icon" class="navIcons">
            </button>
            <ul class="dropdown-menu dropdown-menu-end z-index-up">
                <li class="mob-only"><a class="dropdown-item" href="/library">Bibliothek</a></li>
                <li><a class="dropdown-item" href="/about_me">Über den Entwickler</a></li>
                <li><a class="dropdown-item" href="/about_project">Über das Projekt</a></li>
                <li><a class="dropdown-item" href="/showPatch/2">Patchnotizen</a></li>

                @if (auth()->check())
                    <li><a class="dropdown-item" href="/displayAllTexts">Texte</a></li>
                    <li><a class="dropdown-item" href="/profile">Profil: {{auth()->user()->name}}</a></li>
                    <li>
                    <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Ausloggen</button>
                        </form>
                    </li>
                @else
                    <li><a class="dropdown-item" href="/login">Login</a></li>
                    <li><a class="dropdown-item" href="/register">Register</a></li>
                @endif
            </ul>
        </div>

   </div> 
</nav>
<div class="mainContent">
@yield('content')
</div>
<div class="heightbox"></div>
<footer>
    <!--
    <div class="footer-Wrapper">
        <div class="gradiant-box"></div>
        <div class="desktop-gradiant"></div>
        <div class="footer_box">
            <p>lingua tech</p>
            <div class="horizontal-fill"></div>
            <a href="/about_me">
                <img src="{{ asset('svg-icons/info-icon.svg')}}" alt="impressum Icon" class="icons">
            </a>
            <div class="horizontal-fill"></div>
            <a href="/library">
                <img src="{{ asset('svg-icons/library-icon.svg')}}" alt="library Icon" class="icons ">
            </a>
            <div class="horizontal-fill"></div>
        </div>
    </div>-->
</footer>

</body>
</html>