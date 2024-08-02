@php
    $faculties = \App\Models\Faculty::pluck('name', 'id');
    $professors = \App\Models\Professor::pluck('name', 'id');
@endphp

<form class="space-y-4" action="{{ $dean->id ? route('~dean.update', $dean) : route('~dean.store') }}" method="post">

    @if($dean->id)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $dean->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="faculty_id">Faculté</x-input-label>
        <x-select :items="$faculties" id="faculty_id" name="faculty_id" :value="old('faculty_id', $dean->faculty_id)" placeholder="Selectionner une faculté" />
        <x-input-error :messages="$errors->get('faculty_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="professor_id">Professeur</x-input-label>
        <x-select :items="$professors" id="professor_id" name="professor_id" :value="old('professor_id', $dean->professor_id)" placeholder="Selectionner un professeur" />
        <x-input-error :messages="$errors->get('professor_id')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $dean->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
