<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard | BiteSavr')</title>
    <meta name="description" content="BiteSavr surplus food marketplace dashboard.">
    <meta name="robots" content="noindex, follow">
    <meta name="theme-color" content="#dc2626">
    <link
        rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'><rect width='64' height='64' rx='14' fill='%23dc2626'/><text x='32' y='42' font-family='Arial' font-size='30' font-weight='700' text-anchor='middle' fill='white'>B</text></svg>"
    >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black:wght@400;500;600;700&family=Archivo:wght@400;500;600;700&family=Space+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('tabletop/assets/css/app.css') }}">
</head>
<body data-app="bitesavr">
    <div class="app">
        @include('partials.dashboard.sidebar')

        <div class="main">
            @include('partials.dashboard.header')
            <main class="ct" id="main">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('tabletop/assets/js/app.js') }}"></script>
</body>
</html>
