<x-admin-layout title="Ajouter un professeur">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter un professeur
        </h2>
        <div class="max-w-lg">
            <x-card>
                @include('admin.professor._form', [
                    'professor' => $professor,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
