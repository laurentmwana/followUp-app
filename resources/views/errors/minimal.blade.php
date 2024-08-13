<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>

<body class="flex h-lvh flex-col justify-center items-center">
    <x-container class="p-[50px]">
        <h2
            class="mb-2 text-8xl font-manrope font-black leading-snug text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-indigo-600 to-black/70">
            @yield('code')
        </h2>

        <p class="mb-3 text-sm text-muted-foreground">
            @yield('message')
        </p>

        <x-button-link href="{{ route('welcome') }}">
            Revenir à la page d'accueil
        </x-button-link>
    </x-container>
</body>

</html>
