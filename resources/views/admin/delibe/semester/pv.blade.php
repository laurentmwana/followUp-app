<x-admin-layout title="Déliberation">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            {{ $deliberation->pv !== null ? 'Modifier le PV' : 'Ajouter un PV' }}
        </h2>

        <div class="flex justify-between gap-4 my-4">
            <x-button-link href="{{ route('~delibe.index') }}">
                <div class="flex items-center gap-2">
                    <i class="bi bi-arrow-left"></i>
                    <span>Retourner</span>
                </div>
            </x-button-link>
        </div>

        <div class="max-w-lg">
            @include('admin.delibe.create._form-pv', [
            'path' => route('~delibe.pv', $deliberation),
            'value' => $deliberation->pv
            ])
        </div>

    </x-container>
</x-admin-layout>
