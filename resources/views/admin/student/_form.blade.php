<form class="space-y-4" action="{{ $student->id ? route('~student.update', $student) : route('~student.store') }}"
    method="post">

    @if($student->id)
    @method('PUT')
    <input type="hidden" name="id" value="{{ $student->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom de l'étudiant</x-input-label>
        <x-text-input value="{{ old('name', $student->name) }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="firstname">Postnom de l'etudiant</x-input-label>
        <x-text-input value="{{ old('firstname', $student->firstname) }}" id="firstname" name="firstname" />
        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="happy">Date de naissance</x-input-label>
        <x-text-input type="date" value="{{ old('happy', $student->happy) }}" id="happy" name="happy" />
        <x-input-error :messages="$errors->get('happy')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="phone">Numéro de téléphone</x-input-label>
        <x-text-input type="text" value="{{ old('phone', $student->phone) }}" id="phone" name="phone" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="sex">Sexe</x-input-label>
        <x-select :items="[
            'M' => 'Homme',
            'F' => 'Femme',
        ]" id="sex" name="sex" value="{{ old('sex', $student->sex) }}" placeholder="Selectionner le sexe" />
        <x-input-error :messages="$errors->get('sex')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="levels">Promotion</x-input-label>
        <x-select :items="currentYearLevel()" id="levels" name="levels" value="{{ old('levels', $student->levels) }}"
            placeholder="Selectionner la promotion" />
        <x-input-error :messages="$errors->get('levels')" class="mt-2" />
    </div>


    <div>
        <x-input-label for="choice">Choix d'option</x-input-label>
        <x-select :items="currentYearLevel()" id="choice" name="choice" value="{{ old('choice', $student->choice) }}"
            placeholder="Selectionner une option" />
        <x-input-error :messages="$errors->get('choice')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $student->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>