<x-admin-layout title="Editer la notee #{{ $note->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer la note #{{ $note->id }}
        </h2>

        @include('admin.note._form', [
        'note' => $note,
        ])
    </x-container>
</x-admin-layout>
