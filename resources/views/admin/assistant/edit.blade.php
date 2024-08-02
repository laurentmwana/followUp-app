<x-admin-layout title="Editer l'assistant #{{ $assistant->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer l'assistant #{{ $assistant->id }}
        </h2>

        <div class="max-w-lg">
            <x-card>
                @include('admin.assistant._form', [
                    'assistant' => $assistant,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
