<x-admin-layout title="Editer le cours #{{ $course->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Editer le cours #{{ $course->id }}
        </h2>

        <div class="max-w-lg">
            <x-card>
                @include('admin.course._form', [
                    'course' => $course,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
