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
                        class="font-manrope font-black leading-snug text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-indigo-600 to-black/70">
                        FollowUp
                    </span>
                </a>
                <nav class="flex items-center gap-4 text-sm lg:gap-6">
                    <x-nav-link href="{{ route('dashboard') }}" indexer="dashboard">Tableau de bord</x-nav-link>

                    <x-nav-link href="{{ route('~option.index') }}" indexer="admin/option">Option</x-nav-link>


                    <x-nav-link href="{{ route('~student.index') }}" indexer="admin/student">Etudiant</x-nav-link>

                    <x-nav-link href="{{ route('~level.index') }}" indexer="admin/level">Promotion</x-nav-link>

                    <x-nav-link href="{{ route('~professor.index') }}" indexer="admin/professor">Professeurs
                    </x-nav-link>

                    <x-nav-link href="{{ route('~course.index') }}" indexer="admin/course">Cours</x-nav-link>

                    <x-nav-link href="{{ route('~note.index') }}" indexer="admin/note">Note</x-nav-link>
                    <x-nav-link href="{{ route('~year.index') }}" indexer="admin/year">
                        Année
                    </x-nav-link>

                    <x-nav-link href="{{ route('~delibe.index') }}" indexer="admin/delibe">Délibération</x-nav-link>
                </nav>
            </div>
            <div class="relative md:hidden ">
                <div class="flex items-center justify-center gap-x-5">
                    <a href="/" class="block mt-2">
                        <span
                            class="font-manrope font-black leading-snug text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-indigo-600 to-black/70">
                            FollowUp
                        </span>
                    </a>
                    <div>
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <x-secondary-button>
                                </x-secondary-button>
                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link href="{{ route('dashboard') }}" indexer="dashboard">Tableau de bord
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('~option.index') }}" indexer="admin/option">Option
                                </x-dropdown-link>


                                <x-dropdown-link href="{{ route('~student.index') }}" indexer="admin/student">Etudiant
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('~level.index') }}" indexer="admin/level">Promotion
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('~professor.index') }}" indexer="admin/professor">
                                    Professeurs
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('~course.index') }}" indexer="admin/course">Cours
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('~note.index') }}" indexer="admin/note">Note
                                </x-dropdown-link>


                                <x-dropdown-link href="{{ route('~year.index') }}" indexer="admin/delibe">Année
                                    Academique
                                </x-dropdown-link>


                                <x-dropdown-link href="{{ route('~delibe.index') }}" indexer="admin/delibe">Délibération
                                </x-dropdown-link>
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
                            <x-dropdown-link :href="route('welcome')">
                                Voir le site
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
                @endauth
            </div>
        </div>

    </header>
    <main>
        {{ $slot }}
    </main>
</body>

</html>
