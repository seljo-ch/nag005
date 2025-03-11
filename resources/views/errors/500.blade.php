<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-gray-300 to-gray-500">
    <div class="text-center text-white p-8 rounded-lg shadow-xl bg-blue-600 bg-opacity-90 max-w-md w-full">
        <img src="img/errors/500.webp" alt="500 Bild" class="mx-auto mb-6">

        <h1 class="text-6xl font-bold mb-4">500</h1>
        <p class="text-xl mb-6">Es gab ein Problem auf dem Server. Bitte versuche es später erneut.</p>
        <a href="/" class="btn btn-primary text-white">Zur Startseite</a>
    </div>
</div>

</body>
</html>
