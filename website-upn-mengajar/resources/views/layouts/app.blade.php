<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UPN Mengajar')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('head')
</head>
<body>

    @yield('content')

    @yield('scripts')

</body>
</html>