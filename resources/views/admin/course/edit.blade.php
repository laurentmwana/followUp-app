<x-admin-layout title="Editer le cours #{{ $course->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer le cours #{{ $course->id }}
        </h2>

        @include('admin.course._form', [
        'course' => $course,
        ])
    </x-container>
</x-admin-layout>
