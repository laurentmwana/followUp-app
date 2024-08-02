@php
    $departments = \App\Models\Department::pluck('name', 'id');

@endphp

<form class="space-y-4" action="{{ $option->id ? route('~option.update', $option) : route('~option.store') }}" method="post">

    @if($option->id)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $option->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom du filière</x-input-label>
        <x-text-input value="{{ $option->id ? $option->name : old('name') }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="department_id">Départment</x-input-label>
        <x-select :items="$departments" id="department_id" name="department_id" value="{{ $option->id ? $option->department_id : old('department_id') }}" placeholder="Selectionner un département" />
        <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $option->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
