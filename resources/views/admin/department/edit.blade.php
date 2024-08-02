<x-admin-layout title="Editer le départment #{{ $department->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer le départment #{{ $department->id }}
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
