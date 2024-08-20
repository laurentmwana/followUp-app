<x-admin-layout title="Plus d'information sur la faculté #{{ $faculty->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Plus d'information sur la faculté #{{ $faculty->id }}
        </h2>

        <x-card class="max-w-3xl mb-4">
            <h1 class="text-2xl font-semibold mb-3">
                {{ $faculty->name }}
            </h1>

            @include('shared.ago', [
            'now' => $faculty->created_at
            ])

        </x-card>

    </x-container>
</x-admin-layout>