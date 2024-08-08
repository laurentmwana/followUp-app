<form class="space-y-4"
    action="{{ $professor->id ? route('~professor.update', $professor) : route('~professor.store') }}" method="post">

    @if($professor->id)
    @method('PUT')
    <input type="hidden" name="id" value="{{ $professor->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom du professeur</x-input-label>
        <x-text-input value="{{ old('name', $professor->name) }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="firstname">Postnom du professeur</x-input-label>
        <x-text-input value="{{ old('firstname', $professor->firstname) }}" id="firstname" name="firstname" />
        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="phone">Téléphone</x-input-label>
        <x-text-input value="{{ old('phone', $professor->phone) }}" id="phone" name="phone" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="sex">Sexe</x-input-label>
        <x-select :items="[
            'M' => 'Homme',
            'F' => 'Femme',
        ]" id="sex" name="sex" value="{{ old('sex', $professor->sex) }}" placeholder="Selectionner le sexe" />
        <x-input-error :messages="$errors->get('sex')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $professor->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
