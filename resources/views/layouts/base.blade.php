<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
        {{ $attributes["title"] ?? "" }} -
        {{ config("app.name", "Laravel") }}
    </title>

    <!-- Scripts -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="font-sans">
    <header
        class="sticky top-0 z-50 w-full border-border/40 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60 px-4 xl:px-0">
        <div class="max-w-7xl mx-auto flex h-14 items-center justify-between">
            <div class="mr-4 hidden md:flex">
                <a class="mr-4 flex items-center space-x-2 lg:mr-6" href="/">
                    <span
                        class="font-manrope font-black leading-snug text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-green-600 to-black/70">
                        FollowUp
                    </span>
                </a>
                <nav class="flex items-center gap-4 text-sm lg:gap-6">
                    <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">Accueil
                    </x-nav-link>

                    <x-nav-link indexer="/about" href="{{ route('about') }}" :active="request()->routeIs('about')">A
                        propos</x-nav-link>

                    @auth() @if(isStudent(Auth::user()->role))
                    <x-nav-link indexer="/mon-parcours" href="{{ route('^vz.index') }}"
                        :active="request()->routeIs('^vz.index')">Mon parcours</x-nav-link>
                    <x-nav-link indexer="/reproduction-du-bulletin" href="{{ route('^pdf.index') }}"
                        :active="request()->routeIs('^pdf.index')">Bulletin</x-nav-link>
                    @endif
                    @endauth
                </nav>
            </div>
            <div class="relative md:hidden ">
                <div class="flex items-center justify-center gap-x-5">
                    <a href="/" class="block mt-2">
                        <span
                            class="font-manrope font-black leading-snug text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-green-600 to-black/70">
                            FollowUp
                        </span>
                    </a>
                    <div>
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                @include('shared.button-responsive')
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('welcome')">
                                    Accueil
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('about')">
                                    A propos
                                </x-dropdown-link>
                                @auth()
                                @if(isStudent(Auth::user()->role))
                                <x-dropdown-link :href="route('^vz.index')">
                                    Mon parcours
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('^pdf.index')">
                                    Bulletin
                                </x-dropdown-link>
                                @endif
                                @endauth
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

            </div>

            <div>
                @auth
                <div class="flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @include('shared.avatar', ['name' =>
                            Auth::user()->name])
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __("Profile") }}
                            </x-dropdown-link>

                            @if(isAdmin(Auth::user()->role))
                            <x-dropdown-link :href="route('dashboard')">
                                {{ __("Dashboard") }}
                            </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                    {{ __("Log Out") }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endauth @guest
                <x-button-link variant="secondary" href="{{ route('login') }}">
                    <i class="bi bi-user"></i> Se Connecter
                </x-button-link>
                @endguest
            </div>
        </div>

    </header>
    <main>
        {{ $slot }}
    </main>
</body>

</html>
