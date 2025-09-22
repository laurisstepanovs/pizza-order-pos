<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="flex flex-col min-h-full bg-gray-100">
<header class="text-center p-5 border-b-2 border-gray-200 bg-white">
    <h1 class="text-[20px] font-semibold">@yield('title')</h1>
</header>
<div id="app" class="flex-1">
    @yield('content')
</div>
<footer class="text-center p-5 text-gray-400 text-[15px]">
    <p>Copyright © 2025</p>
</footer>
</body>
</html>
