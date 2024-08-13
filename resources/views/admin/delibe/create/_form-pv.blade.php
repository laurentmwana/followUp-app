@php
$value ??= '';
@endphp

<form class="space-y-6" method="post" action="{{ $path }}"
    onsubmit=" return confirm('Voulez-vous vraiment effectuer cette action ?')">
    @csrf

    @method('put')

    <div>
        <x-input-label for="pv">Procès-verbal (PV)</x-input-label>
        <x-textarea value="{{ old('pv', $value) }}" id="pv" name="pv" />
        <x-input-error :messages="$errors->get('pv')" class="mt-2" />
    </div>

    <x-secondary-button type="submit">
        <div class="flex items-center gap-2">
            <i class="bi bi-pen"></i>
        </div>
    </x-secondary-button>
</form>
