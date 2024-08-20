<x-admin-layout title="Plus d'information sur le département #{{ $department->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Plus d'information sur le département #{{ $department->id }}
        </h2>

        <x-card class="max-w-3xl mb-4">
            <h1 class="text-2xl font-semibold mb-3">
                {{ $department->name }} - {{ $department->alias }}
            </h1>

            @include('shared.ago', [
            'now' => $department->created_at
            ])
        </x-card>

        <div>
            <h2 class="mb-4 font-semibold text-xl">
                Options
            </h2>
            <div class="flex items-center gap-4 mb-4">
                @foreach ($options as $option)
                <a href="{{ route('~option.show', $option) }}">
                    <x-badge>
                        {{ $option->name }}
                    </x-badge>
                </a>
                @endforeach
            </div>
        </div>

        <div>
            {{ $options->links() }}
        </div>
    </x-container>
</x-admin-layout>