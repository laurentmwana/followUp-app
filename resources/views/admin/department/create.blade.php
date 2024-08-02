<x-admin-layout title="Ajouter un département">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter un département
        </h2>

        <div class="max-w-lg">
            <x-card>
                @include('admin.department._form', [
                    'department' => $department,
                ])
            </x-card>
           </div>

    </x-container>
</x-admin-layout>
