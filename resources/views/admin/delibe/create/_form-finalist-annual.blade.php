<form method="post" action="{{ route('~finalist-year') }}" class="space-y-4" method="post"
    onsubmit="return confirm('Voulez-vous vraiment effectuer cette action ?')">
    @csrf

    <input type="hidden" name="programme" value="{{ $programmeId }}">
    <div>
        <x-input-label for="option_id">Option</x-input-label>
        <x-select :items="formatOptions()" value="{{ old('option_id') }}" id="option_id" name="option_id"
            placeholder="Selectionner une option" />
        <x-input-error :messages="$errors->get('option_id')" class="mt-2" />
    </div>

    <x-secondary-button type="submit">
        <div class="flex items-center gap-2">
            <i class="bi bi-pen"></i>
            Effectuer
        </div>
    </x-secondary-button>
</form>
