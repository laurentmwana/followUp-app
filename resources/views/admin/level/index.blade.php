<x-admin-layout title="Gestion de promotions">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">Gestion de promotions</h2>

        <div class="max-w-sm mb-4">
            @include('admin.level._filter')
        </div>

        @include('admin.level.level-table', [
        'levels' => $levels
        ])

      
    </x-container>
</x-admin-layout>
