<x-admin-layout title="Ajouter une note">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter une note
        </h2>
        <div class="mb-3">
            @include('shared.flash')
        </div>
        @include('admin.note._form', [
        'note' => $note,
        ])
    </x-container>
</x-admin-layout>
