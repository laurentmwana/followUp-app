@php
$levels = \App\Models\Level::with(['programme', 'year', 'option'])->get();
@endphp



<form class="space-y-4" action="{{ $student->id ? route('~student.update', $student) : route('~student.store') }}"
    method="post">

    @if($student->id)
    @method('PUT')
    <input type="hidden" name="id" value="{{ $student->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom de l'étudiant</x-input-label>
        <x-text-input value="{{ $student->id ? $student->name : old('name') }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="firstname">Postnom de l'etudiant</x-input-label>
        <x-text-input value="{{ $student->id ? $student->firstname : old('firstname') }}" id="firstname"
            name="firstname" />
        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="lastname">Postnom de l'etudiant</x-input-label>
        <x-text-input value="{{ $student->id ? $student->lastname : old('lastname') }}" id="lastname" name="lastname" />
        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email">Adresse e-mail</x-input-label>
        <x-text-input value="{{ $student->id ? $student->email : old('email') }}" id="email" name="email" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="happy">Date de naissance</x-input-label>
        <x-text-input type="date" value="{{ $student->id ? $student->happy : old('happy') }}" id="happy" name="happy" />
        <x-input-error :messages="$errors->get('happy')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="sexy">Sexe</x-input-label>
        <x-select :items="[
            'M' => 'Homme',
            'F' => 'Femme',
        ]" id="sexy" name="sexy" value="{{ $student->id ? $student->sexy : old('sexy') }}"
            placeholder="Selectionner le sexe" />
        <x-input-error :messages="$errors->get('sexy')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="level_id">Promotion</x-input-label>
        <x-select :items="formatLevelToProgramme($levels)" id="level_id" name="level_id"
            value="{{ $student->id ? $student->level_id : old('level_id') }}"
            placeholder="Selectionner une promotion" />
        <x-input-error :messages="$errors->get('level_id')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $student->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
