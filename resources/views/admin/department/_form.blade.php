@php
    $faculties = \App\Models\Faculty::pluck('name', 'id');

@endphp

<form class="space-y-4" action="{{ $department->id ? route('~department.update', $department) : route('~department.store') }}" method="post">

    @if($department->id)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $department->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom du département</x-input-label>
        <x-text-input value="{{ $department->id ? $department->name : old('name') }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="alias">Alias</x-input-label>
        <x-text-input value="{{ $department->id ? $department->alias : old('alias') }}" id="alias" name="alias" />
        <x-input-error :messages="$errors->get('alias')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="faculty_id">Faculté</x-input-label>
        <x-select :items="$faculties" id="faculty_id" name="faculty_id" value="{{ $department->id ? $department->faculty_id : old('faculty_id') }}" placeholder="Selectionner la faculté" />
        <x-input-error :messages="$errors->get('faculty_id')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $department->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
