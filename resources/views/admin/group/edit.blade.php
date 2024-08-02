<x-admin-layout title="Editer le groupe #{{ $group->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer le groupe #{{ $group->id }}
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
