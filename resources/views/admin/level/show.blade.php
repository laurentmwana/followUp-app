<x-admin-layout title="Plus d'information sur la promotion #{{ $level->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Plus d'information sur la promotion #{{ $level->id }}
        </h2>

        <div class="space-y-6">
            <x-card class="max-w-4xl">
                <div class="mb-2">
                    <x-badge>
                        Promotion
                    </x-badge>

                    <x-badge>
                        {{ $level->year->start }} - {{ $level->year->end }}
                    </x-badge>
                </div>

                <h1 class="mb-2 text-2xl font-semibold text-gray-700 dark:text-gray-100">
                    {{ $level->programme->name }} - {{ $level->programme->alias }}
                </h1>

                <p class="text-base text-muted-foreground mb-3">
                    {{ $level->option->name }}
                </p>

                @include('shared.ago', [
                'now' => $level->created_at
                ])

            </x-card>


            <div>
                <h2 class="text-gray-700 dark:text-gray-50 text-base font-semibold mb-4">
                    Etudiants
                </h2>
                @include('admin.student.student-table', [
                'students' => $students
                ])
            </div>
        </div>


    </x-container>
</x-admin-layout>