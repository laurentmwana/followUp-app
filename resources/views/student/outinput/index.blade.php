<x-app-layout title="Production du bulletin de l’étudiant #{{ $student->id }}">
    <x-container class="py-12">
        <div class="max-w-5xl mx-auto mt-5">

            <div class="mb-4">
                @include('student.outinput._form-select', [
                'programmeId' => 1,
                'semesterId' => null
                ])
            </div>

            <div>
                @include('student.vz.student', [
                'student' => $student,
                ])
            </div>
        </div>
    </x-container>
</x-app-layout>
