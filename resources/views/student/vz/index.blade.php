<x-base-layout title="Mon parcours">
    <x-container class="py-12">
        <h2 class="text-base font-medium text-muted-foreground">
            Mon parcours
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mt-5">
            <div class="lg:cols-span-1">
                <div class="flex items-center gap-x-4">
                    @include('shared.year', [ 'years' => $years, ])
                    @include('shared.programme', [ 'programmes' => $programmes,
                    ])
                </div>
            </div>
            <div class="lg:cols-span-3 md:col-span-2">
                @include('student.vz.student', [
                    'student' => $student,
                ])
            </div>
        </div>
    </x-container>
</x-base-layout>
