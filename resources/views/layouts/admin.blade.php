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
            class="sticky top-0 z-50 w-full border-border/40 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60"
        >
            <div class="max-w-7xl mx-auto flex h-14 items-center">
                <div class="mr-4 hidden md:flex">
                    <a
                        class="mr-4 flex items-center space-x-2 lg:mr-6"
                        href="{{ route('dashboard') }}"
                    >
                        <span class="font-manrope font-black leading-snug text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-indigo-600 to-black/70"> FollowUp </span>
                    </a>
                    <nav class="flex items-center gap-4 text-sm lg:gap-6">
                        <x-nav-link
                            href="{{ route('dashboard') }}"
                            indexer="dashboard"
                            >Tableau de bord</x-nav-link
                        >

                        <x-nav-link
                            href="{{ route('~faculty.index') }}"
                            indexer="admin/faculty"
                            >Faculté</x-nav-link
                        >

                        <x-nav-link
                            href="{{ route('~department.index') }}"
                            indexer="admin/department"
                            >Départment</x-nav-link
                        >

                        <x-nav-link
                            href="{{ route('~option.index') }}"
                            indexer="admin/option"
                            >Option</x-nav-link
                        >

                        <x-nav-link
                            href="{{ route('~level.index') }}"
                            indexer="admin/level"
                            >Promotion</x-nav-link
                        >

                        <x-nav-link
                            href="{{ route('~student.index') }}"
                            indexer="admin/student"
                            >Etudiant</x-nav-link
                        >

                        <x-nav-link
                            href="{{ route('~professor.index') }}"
                            indexer="admin/professor"
                            >Professeurs</x-nav-link
                        >

                        <x-nav-link
                            href="{{ route('~course.index') }}"
                            indexer="admin/course"
                            >Cours</x-nav-link
                        >

                        <x-nav-link
                        href="{{ route('~note.index') }}"
                        indexer="admin/note"
                        >Note</x-nav-link
                    >

                    <x-nav-link
                    href=""
                    >Délibération</x-nav-link
                >

                    </nav>
                </div>
                <button
                    class="inline-flex items-center justify-center whitespace-nowrap rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 py-2 mr-2 px-0 text-base hover:bg-transparent focus-visible:bg-transparent focus-visible:ring-0 focus-visible:ring-offset-0 md:hidden"
                    type="button"
                    aria-haspopup="dialog"
                    aria-expanded="false"
                    aria-controls="radix-:R15u6ja:"
                    data-state="closed"
                >
                    <svg
                        stroke-width="1.5"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                    >
                        <path
                            d="M3 5H11"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M3 12H16"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M3 19H21"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path></svg
                    ><span class="sr-only">Toggle Menu</span>
                </button>
                <div
                    class="flex flex-1 items-center justify-between space-x-2 md:justify-end"
                >
                    <nav class="flex items-center">
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground py-2 h-8 w-8 px-0"
                            href=""
                        >
                        </a>
                    </nav>
                </div>
            </div>
        </header>
        <main>
            {{ $slot }}
        </main>
    </body>
</html>
