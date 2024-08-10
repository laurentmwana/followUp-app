@php
$categories = \App\Models\Category::pluck('name', 'id');
$semesters = \App\Models\Semester::pluck('name', 'id');

@endphp

<form class="space-y-4" action="{{ $group->id ? route('~group.update', $group) : route('~group.store') }}"
    method="post">

    @if($group->id)
    @method('PUT')
    <input type="hidden" name="id" value="{{ $group->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom du group</x-input-label>
        <x-text-input value="{{ old('name', $group->name) }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="category_id">Categorie</x-input-label>
        <x-select :items="$categories" id="category_id" name="category_id"
            value="{{ old('category_id', $group->category_id) }}" placeholder="Selectionner une categorie" />
        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="semester_id">Semestre</x-input-label>
        <x-select :items="$semesters" id="semester_id" name="semester_id"
            value="{{ old('semester_id', $group->semester_id) }}" placeholder="Selectionner un semstre" />
        <x-input-error :messages="$errors->get('semester_id')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $group->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
