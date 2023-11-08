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
</nav>
@yield('content')
<footer>
    <p>lingua tech</p>
</footer>
</body>
</html>