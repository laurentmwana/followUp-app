@php

$programmeId = request()->query->get('programme', null);
$semesterId = request()->query->get('semester', null);

$students = formatLevelToStudent($programmeId);
$courses = formatCourseToGroup($semesterId);
@endphp

<div class="flex gap-4 flex-wrap w-ful">
    <div>
        @include('shared.programme', [
        'routeName' => $note->id ? '~note.edit' : '~note.create',
        'routeParams' => $note->id ? ['note' => $note] : [],
        ])
    </div>

    <div class="sm:w-full lg:max-w-lg">
        <x-card class="bg-inherit">

            @if ($errors->get('semester_id'))
            <div class="mb-4">
                <x-alert variant="error">

                    {{ $errors->get('semester_id') }}
                </x-alert>
            </div>
            @endif

            <div>
                <form class="space-y-4" action="{{ $note->id ? route('~note.update', $note) : route('~note.store') }}"
                    method="post">

                    @if($note->id)
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $note->id }}">
                    @endif
                    @csrf

                    <input type="hidden" name="semester_id" value="{{ $semesterId }}">

                    <div>
                        <x-input-label for="note">Note</x-input-label>
                        <x-text-input type="number" value="{{ old('note', $note->note) }}" id="note" name="note" />
                        <x-input-error :messages="$errors->get('note')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="student_id">Etudiants </x-input-label>
                        <x-select :items="$students" id="student_id" name="student_id"
                            value="{{ old('student_id', $note->student_id) }}" placeholder="Selectionner un étudiant" />
                        <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="course_id">Cours </x-input-label>
                        <x-select :items="$courses" id="course_id" name="course_id"
                            value="{{ old('course_id', $note->course_id) }}" placeholder="Selectionner un cours" />
                        <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
                    </div>

                    <x-primary-button>
                        <i class="bi {{ $note->id ? 'bi-pen' : 'bi-plus' }}"></i>
                    </x-primary-button>

                </form>
            </div>

        </x-card>
    </div>

</div>
