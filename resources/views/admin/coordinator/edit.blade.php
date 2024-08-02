<x-admin-layout title="Editer le chef de travaux #{{ $coordinator->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer le chef de travaux #{{ $coordinator->id }}
        </h2>

        <div class="max-w-lg">
            <x-card>
                @include('admin.coordinator._form', [
                    'coordinator' => $coordinator,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
