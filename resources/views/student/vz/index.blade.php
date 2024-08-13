<x-base-layout title="Mon parcours">
    <x-container class="py-12">
        <h2 class="text-base font-medium text-muted-foreground mb-4">
            Mon parcours
        </h2>

        <div class="grid grid-cols-4 gap-6">
            <div class="col-span-1">
                @include('shared.programme')
            </div>
            <div class="col-span-3">
                @include('student.vz.student', [
                'student' => $student,
                ])
            </div>
        </div>
    </x-container>
</x-base-layout>
