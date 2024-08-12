<x-app-layout title="Mon parcours">
    <x-container class="py-12">
        <div class="max-w-5xl mt-5">
            @include('student.vz.student', [
            'student' => $student,
            ])
        </div>
    </x-container>
</x-app-layout>
