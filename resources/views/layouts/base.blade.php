<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&family=Nunito:wght@400;600&family=Comfortaa:wght@700&family=Pacifico&display=swap"
        rel="stylesheet" />

    @vite(['../resources/css/app.css', '../resources/js/app.js'])

    <script defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen">
    {{ $slot }}
</body>

</html>
