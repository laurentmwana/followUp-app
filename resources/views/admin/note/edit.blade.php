<x-admin-layout title="Editer la notee #{{ $note->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer la note #{{ $note->id }}
        </h2>

        <div class="max-w-lg">
            <x-card>
                @include('admin.note._form', [
                    'note' => $note,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
