<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dark-theme="dark" class="scheme-light dark:scheme-dark ...">
<head>
    @viteReactRefresh
    @vite(['resources/js/app.jsx', 'resources/css/app.css'])
    @inertiaHead
</head>
<body>
    @routes
    @inertia
</body>
</html>