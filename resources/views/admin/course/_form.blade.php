@php
$professors = \App\Models\Professor::pluck('name', 'id');

$semesterId = request()->query->get('semester');

$groups = \App\Models\Group::whereSemesterId($semesterId)->pluck('name', 'id');

@endphp

<div class="flex gap-4 flex-wrap w-ful">
    <div>
        @include('shared.programme', [
        'routeName' => $course->id ? '~course.edit' : '~course.create',
        'routeParams' => $course->id ? ['course' => $course] : [],
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
                <form class="space-y-4"
                    action="{{ $course->id ? route('~course.update', $course) : route('~course.store') }}"
                    method="post">

                    @if($course->id)
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $course->id }}">
                    @endif
                    @csrf

                    <input type="hidden" name="semester_id" value="{{ $semesterId }}">

                    <div>
                        <x-input-label for="name">Nom du cours</x-input-label>
                        <x-text-input value="{{ $course->id ? $course->name : old('name') }}" id="name" name="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="credits">Crédits</x-input-label>
                        <x-text-input type="number" value="{{ $course->id ? $course->credits : old('credits') }}"
                            id="credits" name="credits" />
                        <x-input-error :messages="$errors->get('credits')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="professor_id">Professeur </x-input-label>
                        <x-select :items="$professors" id="professor_id" name="professor_id"
                            value="{{ $course->id ? $course->professor_id : old('professor_id') }}"
                            placeholder="Selectionner une promotion" />
                        <x-input-error :messages="$errors->get('professor_id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="group_id">Groupe</x-input-label>
                        <x-select :items="$groups" id="group_id" name="group_id"
                            value="{{ $course->id ? $course->group_id : old('group_id') }}"
                            placeholder="Selectionner une promotion" />
                        <x-input-error :messages="$errors->get('group_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description">Description</x-input-label>
                        <x-textarea value="{{ $course->id ? $course->description : old('description') }}"
                            id="description" name="description" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <x-primary-button>
                        <i class="bi {{ $course->id ? 'bi-pen' : 'bi-plus' }}"></i>
                    </x-primary-button>


                </form>
            </div>


        </x-card>
    </div>

</div>
