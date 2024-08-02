@php
    $courses = \App\Models\Course::pluck('name', 'id');

@endphp

<form class="space-y-4" action="{{ $assistant->id ? route('~assistant.update', $assistant) : route('~assistant.store') }}" method="post">

    @if($assistant->id)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $assistant->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom de l'assistant</x-input-label>
        <x-text-input value="{{ $assistant->id ? $assistant->name : old('name') }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="firstname">Postnom de l'assistant</x-input-label>
        <x-text-input value="{{ $assistant->id ? $assistant->firstname : old('firstname') }}" id="firstname" name="firstname" />
        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email">Adresse e-mail</x-input-label>
        <x-text-input type="email" value="{{ $assistant->id ? $assistant->email : old('email') }}" id="email" name="email" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="phone">Téléphone</x-input-label>
        <x-text-input value="{{ $assistant->id ? $assistant->phone : old('phone') }}" id="phone" name="phone" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="sex">Sexe</x-input-label>
        <x-select :items="[
            'M' => 'Homme',
            'F' => 'Femme',
        ]" id="sex" name="sex" value="{{ $assistant->id ? $assistant->sex : old('sex') }}" placeholder="Selectionner le sexe" />
        <x-input-error :messages="$errors->get('sex')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="courses">Cours</x-input-label>
        <x-select-multiple :items="$courses" id="courses" name="courses[]" :value="old('courses', $assistant->courses)" placeholder="Selectionner les cours" />
        <x-input-error :messages="$errors->get('courses')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $assistant->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
