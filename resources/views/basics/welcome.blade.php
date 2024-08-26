<x-base-layout title="Bienvenu(e)">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
        <a href="{{ route('^vz.index') }}"
            class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
            role="alert">
            <span class="text-xs bg-primary rounded-full text-white px-4 py-1.5 mr-3">New</span> <span
                class="text-sm font-medium">Suivi de mon parcours academique</span>
            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
        <h1
            class="text-4xl font-extrabold tracking-tight md:text-5xl lg:text-6xl leading-snug text-transparent bg-clip-text bg-gradient-to-r from-primary/50 via-primary/70 to-black/70 mb-6">
            Welcome To FollowUp</h1>
        <p class="mb-8 text-lg font-normal text-muted-foreground lg:text-xl sm:px-16 xl:px-48">
            FollowUp est une application web dédiée au suivi des délibérations des étudiants de l'Université de Kinshasa
            ! Notre plateforme innovante a été spécialement conçue pour vous offrir une gestion simplifiée et
            transparente des résultats...
        </p>
        <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            <a href="{{route('about') }}"
                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-primary hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                Lire la suite
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>

</x-base-layout>
