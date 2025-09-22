<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="flex flex-col min-h-full">
<header class="text-center p-5">
    <h1 class="text-[20px]">@yield('title')</h1>
</header>
<div id="app" class="flex-1">
    @yield('content')
</div>
<footer class="text-center p-5">
    <p>Copyright © 2025</p>
</footer>
</body>
</html>
