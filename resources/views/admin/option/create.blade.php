<x-admin-layout title="Ajouter une option">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter une option
        </h2>

        <div class="max-w-lg">
            <x-card>
                @include('admin.option._form', [
                    'option' => $option,
                ])
            </x-card>
           </div>

    </x-container>
</x-admin-layout>
