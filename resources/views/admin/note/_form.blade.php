@php
    $students = \App\Models\Student::pluck('name', 'id');
    $semesters = \App\Models\Semester::pluck('name', 'id');
    $courses = \App\Models\Course::pluck('name', 'id');

@endphp

<form class="space-y-4" action="{{ $note->id ? route('~note.update', $note) : route('~note.store') }}" method="post">

    @if($note->id)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $note->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="note">Note Obtenue</x-input-label>
        <x-text-input value="{{ $note->id ? $note->note : old('note') }}" id="note" name="note" />
        <x-input-error :messages="$errors->get('note')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="student_id">Etudiant</x-input-label>
        <x-select :items="$students" id="student_id" name="student_id" value="{{ $note->id ? $note->student_id : old('student_id') }}" placeholder="Selectionner un étudiant" />
        <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="course_id">Cours</x-input-label>
        <x-select :items="$courses" id="course_id" name="course_id" value="{{ $note->id ? $note->course_id : old('course_id') }}" placeholder="Selectionner un cours" />
        <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="semester_id">Semestre</x-input-label>
        <x-select :items="$semesters" id="semester_id" name="semester_id" value="{{ $note->id ? $note->semester_id : old('semester_id') }}" placeholder="Selectionner un semestre" />
        <x-input-error :messages="$errors->get('semester_id')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $note->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
