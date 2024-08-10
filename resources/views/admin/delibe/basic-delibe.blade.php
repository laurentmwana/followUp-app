<x-admin-layout title="Résultat de la délibération">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Résultat de la délibération pour <em> {{ $programme->name }} {{ $semester->name }}</em>
        </h2>

        @include('shared.flash')

        <div>
            <div class="flex gap-4 flex-wrap w-ful">

            </div>
        </div>
    </x-container>
</x-admin-layout>
