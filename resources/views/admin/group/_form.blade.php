@php
    $categories = \App\Models\Category::pluck('name', 'id');

@endphp

<form class="space-y-4" action="{{ $group->id ? route('~group.update', $group) : route('~group.store') }}" method="post">

    @if($group->id)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $group->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom du group</x-input-label>
        <x-text-input value="{{ $group->id ? $group->name : old('name') }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="category_id">Categorie</x-input-label>
        <x-select :items="$categories" id="category_id" name="category_id" value="{{ $group->id ? $group->category_id : old('category_id') }}" placeholder="Selectionner une categorie" />
        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $group->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
