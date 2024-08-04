<x-admin-layout title="Editer l'utilisateur #{{ $user->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer l'utilisateur #{{ $user->id }}
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
