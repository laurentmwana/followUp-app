<x-admin-layout title="Plus d'information sur l'option #{{ $option->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Plus d'information sur l'option #{{ $option->id }}
        </h2>

        <div class="max-w-3xl mb-4">
            <x-card>
                <div class="mb-3">
                    <x-badge>
                        Option
                    </x-badge>
                </div>
                <div class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-2">
                    {{ $option->name }} ~ {{ $option->alias }}
                </div>

                @include('shared.ago', [
                'now' => $option->created_at
                ])
            </x-card>
        </div>

        <div>
            <h2 class="mb-4 text-base font-semibold">Promotion</h2>
            @include('admin.level.level-table', [
            'levels' => $levels
            ])
        </div>
    </x-container>
</x-admin-layout>