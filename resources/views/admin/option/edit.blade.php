<x-admin-layout title="Editer l'option #{{ $option->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer l'option #{{ $option->id }}
        </h2>

        <div class="max-w-lg">
            <x-card>
                @include('admin.option._form', [
                    'option' => $option,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
