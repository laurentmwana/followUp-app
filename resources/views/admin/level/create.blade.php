<x-admin-layout title="Ajouter une promotion">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter une promotion
        </h2>
        <div class="max-w-lg">
            <x-card>
                @include('admin.level._form', [
                    'level' => $level,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
