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
        <img src="{{ asset('svg-icons/home-icon.svg')}}" alt="home Icon" class="icons navIcons">
    </a>
        <div class="horizontal-fill"></div>
        <p id="navText">LinguaTech</p>
        <div class="horizontal-fill"></div>
        <!-- make a dropdown menu for the following links -->
        <div class="langDropdownMenu">
                <input type="checkbox" id="dropdownCheckbox" class="dropdownCheckbox" />
                <label for="dropdownCheckbox" class="dropdownLabel">
                    <div class="displayFlex">
                        <p>{{ strtoupper(App::getLocale()) }}</p>
                        <img src="{{ asset('svg-icons/arrow-down-icon.svg')}}" style="height:30px;"alt="icon für Spracheinstellung">
                    </div>
            </label>
            <ul class="dropdown-content">
                <li><a href="{{ route('language.change', 'de') }}">Deutsch</a></li>
                <li><a href="{{ route('language.change', 'en') }}">English</a></li>
            </ul>
        </div>



        @if (auth()->check())
            <a href="/about_project" class="iconWrapper">
                <img src="{{ asset('svg-icons/info-icon.svg')}}" alt="impressum Icon" class="icons des-only">
            </a>
            <a href="/library" class="iconWrapper">
                <img  src="{{ asset('svg-icons/library-icon.svg')}}" alt="library Icon" class="icons navIcons des-only">
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
                <li class="mob-only"><a class="dropdown-item" href="/library">{{ __('menu.library') }}</a></li>
                <li><a class="dropdown-item" href="/about_me">{{ __('menu.aboutDeveloper') }}</a></li>
                <li><a class="dropdown-item" href="/about_project">{{ __('menu.aboutProject') }}</a></li>
                <li><a class="dropdown-item" href="/showPatch/2">{{ __('menu.patchNotes') }}</a></li>

                @if (auth()->check())
                    <li><a class="dropdown-item" href="/displayAllTexts">{{ __('menu.texts') }}</a></li>
                    <li><a class="dropdown-item" href="/profile">{{ __('menu.profile', ['name' => auth()->user()->name]) }}</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">{{ __('menu.logout') }}</button>
                        </form>
                    </li>
                @else
                    <li><a class="dropdown-item" href="/login">{{ __('menu.login') }}</a></li>
                    <li><a class="dropdown-item" href="/register">{{ __('menu.register') }}</a></li>
                @endif
            </ul>
        </div>


   </div> 
</nav>
<div class="mainContent">
@yield('content')
</div>
<div class="heightbox"></div>

</body>
</html>