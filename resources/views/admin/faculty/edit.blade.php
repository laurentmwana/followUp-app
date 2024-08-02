<x-admin-layout title="Editer la faculté #{{ $faculty->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer la faculté #{{ $faculty->id }}
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
