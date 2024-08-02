<x-admin-layout title="Editer le doyen #{{ $dean->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer le doyen #{{ $dean->id }}
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
