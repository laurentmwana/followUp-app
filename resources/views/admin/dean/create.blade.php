<x-admin-layout title="Ajouter un doyen">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter un doyen
        </h2>
        <div class="max-w-lg">
            <x-card>
                @include('admin.dean._form', [
                    'dean' => $dean,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
