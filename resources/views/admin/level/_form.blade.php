@php
    $options = \App\Models\Option::pluck('name', 'id');

@endphp

<form class="space-y-4" action="{{ $level->id ? route('~level.update', $level) : route('~level.store') }}" method="post">

    @if($level->id)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $level->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Promotion</x-input-label>
        <x-text-input value="{{ $level->id ? $level->name : old('name') }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="option_id">Départment</x-input-label>
        <x-select :items="$options" id="option_id" name="option_id" value="{{ $level->id ? $level->option_id : old('option_id') }}" placeholder="Selectionner une option" />
        <x-input-error :messages="$errors->get('option_id')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $level->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
