<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>linguaTech-@yield('title')</title>
    <!-- scripts and styles-->
    @vite(['resources/css/main.scss', 'resources/js/app.js'])
</head>
<body>
<nav>
    <p>lingua tech</p>
    <img src="{{ asset('icons/books-icon.svg')}}" alt="book Icon">
    <img src="{{ asset('icons/home-icon.svg')}}" alt="home Icon">
    <img src="{{ asset('icons/library-icon.svg')}}" alt="library Icon">
    <p id="navText">LinguaTech</p>
    <img src="{{ asset('icons/menu-icon.svg')}}" alt="menu Icon">
    <img src="{{ asset('icons/pencil-icon.svg')}}" alt="pencil Icon">
    <!--  -->
</nav>
@yield('content')
<footer>
    <p>lingua tech</p>
</footer>
</body>
</html>