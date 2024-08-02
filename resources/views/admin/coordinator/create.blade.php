<x-admin-layout title="Ajouter un chef de travaux">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter un chef de travaux
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
