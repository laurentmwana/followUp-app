<x-admin-layout title="Ajouter un utilisateur">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter un utilisateur
        </h2>
        <div class="max-w-lg">
            <x-card>
                @include('admin.user._form', [
                    'user' => $user,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
