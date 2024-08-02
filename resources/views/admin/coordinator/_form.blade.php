@php
    $courses = \App\Models\Course::pluck('name', 'id');

@endphp

<form class="space-y-4" action="{{ $coordinator->id ? route('~coordinator.update', $coordinator) : route('~coordinator.store') }}" method="post">

    @if($coordinator->id)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $coordinator->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom du chef de travaux</x-input-label>
        <x-text-input value="{{ $coordinator->id ? $coordinator->name : old('name') }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="firstname">Postnom du chef de travaux</x-input-label>
        <x-text-input value="{{ $coordinator->id ? $coordinator->firstname : old('firstname') }}" id="firstname" name="firstname" />
        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email">Adresse e-mail</x-input-label>
        <x-text-input type="email" value="{{ $coordinator->id ? $coordinator->email : old('email') }}" id="email" name="email" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="phone">Téléphone</x-input-label>
        <x-text-input value="{{ $coordinator->id ? $coordinator->phone : old('phone') }}" id="phone" name="phone" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="sex">Sexe</x-input-label>
        <x-select :items="[
            'M' => 'Homme',
            'F' => 'Femme',
        ]" id="sex" name="sex" value="{{ $coordinator->id ? $coordinator->sex : old('sex') }}" placeholder="Selectionner le sexe" />
        <x-input-error :messages="$errors->get('sex')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="courses">Cours</x-input-label>
        <x-select-multiple :items="$courses" id="courses" name="courses[]" :value="old('courses', $coordinator->courses)" placeholder="Selectionner les cours" />
        <x-input-error :messages="$errors->get('courses')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $coordinator->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
