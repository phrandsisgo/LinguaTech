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
   <div class="nav-wrapper">
        <img src="{{ asset('icons/home-icon.svg')}}" alt="home Icon" class="icons">
        <div class="horizontal-fill"></div>
        <p id="navText">LinguaTech</p>
        <div class="horizontal-fill"></div>
        <img src="{{ asset('icons/info-icon.svg')}}" alt="impressum Icon" class="icons des-only">
        <img src="{{ asset('icons/library-icon.svg')}}" alt="library Icon" class="icons des-only">
        <img src="{{ asset('icons/menu-icon.svg')}}" alt="menu Icon" class="icons">
        <!--  -->
   </div> 
</nav>
<div class="mainContent">
@yield('content')
</div>
<div class="heightbox"></div>
<footer>
    <div class="footer-Wrapper">
        <div class="gradiant-box"></div>
        <div class="footer_box">
            <p>lingua tech</p>
            <div class="horizontal-fill"></div>
            <img src="{{ asset('icons/info-icon.svg')}}" alt="impressum Icon" class="icons">
            <div class="horizontal-fill"></div>
            <img src="{{ asset('icons/library-icon.svg')}}" alt="library Icon" class="icons ">
            <div class="horizontal-fill"></div>
        </div>
    </div>
</footer>

</body>
</html>