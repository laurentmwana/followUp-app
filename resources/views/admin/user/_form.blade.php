@php
    $students = \App\Models\Student::pluck('name', 'id');

@endphp

<form class="space-y-4" action="{{ $user->id ? route('~user.update', $user) : route('~user.store') }}" method="post">

    @if($user->id)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $user->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom</x-input-label>
        <x-text-input value="{{ $user->id ? $user->name : old('name') }}" id="user" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email">Email</x-input-label>
        <x-text-input value="{{ $user->id ? $user->email : old('email') }}" id="email" name="email" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="student_id">Etudiant</x-input-label>
        <x-select :items="$students" id="student_id" name="student_id" value="{{ $user->id ? $user->student_id : old('student_id') }}" placeholder="Selectionner un étudiant" />
        <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password">Mot de passe</x-input-label>
        <x-text-input type="password" id="password" name="password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <p class="mt-2 text-[11px]  text-muted-foreground">
                mot de passe par défault : 123456789
            </p>
    </div>

    <x-primary-button>
        <i class="bi {{ $user->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
