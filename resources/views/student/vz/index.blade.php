<x-base-layout title="Mon parcours">
    <x-container class="py-12">
        <h2 class="text-base font-medium text-muted-foreground">
            Mon parcours
        </h2>

        <div class="grid grid-cols-5 mt-5">
            <div class="col-span-2">
                <div class="flex items-center gap-x-4">
                    @include('shared.year', [ 'years' => $years, ])
                    @include('shared.programme', [ 'programmes' => $programmes,
                    ])
                </div>
            </div>
            <div class="col-span-3">
                @include('student.vz.student', [
                'student' => $student,
                ])
            </div>
        </div>
    </x-container>
</x-base-layout>
