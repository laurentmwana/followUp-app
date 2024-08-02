<x-admin-layout title="Ajouter un groupe">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter un groupe
        </h2>
        <div class="max-w-lg">
            <x-card>
                @include('admin.group._form', [
                    'group' => $group,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
