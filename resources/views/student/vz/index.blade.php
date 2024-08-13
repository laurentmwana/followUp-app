<x-base-layout title="Mon parcours">
    <x-container class="py-12">
        <h2 class="text-base font-medium text-muted-foreground">
            Mon parcours
        </h2>

        <div class="grid grid-cols-3 mt-5">
            <div>
                <div class="flex items-center gap-x-4">
                    @include('shared.programme')
                </div>
            </div>
            <div class="col-span-2">
                @include('student.vz.student', [
                'student' => $student,
                ])
            </div>
        </div>
    </x-container>
</x-base-layout>
