<x-admin-layout title="Gestion de faculté">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter une faculté
        </h2>

        <div class="max-w-lg">
            <x-card>
                @include('admin.faculty._form', [
                    'faculty' => $faculty,
                ])
            </x-card>
           </div>

    </x-container>
</x-admin-layout>
