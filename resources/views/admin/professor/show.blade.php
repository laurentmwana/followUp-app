<x-admin-layout title="Plus d'information sur le professeur #{{ $professor->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Plus d'information sur le professeur #{{ $professor->id }}
        </h2>

        <div class="max-w-3xl space-y-5">
            <x-card>
                <h2 class="text-base font-semibold text-gray-800 dark:text-gray-100 mb-4">
                    Information personnelle
                </h2>
                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Nom du professeur : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $professor->name }}
                    </p>
                </div>
                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Postnom du professeur : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $professor->firstname }}
                    </p>
                </div>
                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Genre : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $professor->sex }}
                    </p>
                </div>
                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Numéro de téléphone : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $professor->phone }}
                    </p>
                </div>

                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Enregistrer : </p>
                    @include('shared.ago', [
                    'now' => $professor->created_at
                    ])
                </div>
            </x-card>

            <div>
                <h2 class="mb-5 text-base font-semibold text-gray-700 dark:text-gray-100">Cours</h2>
                <div class="flex items-center gap-x-4 gap-y-3">

                    @foreach ($courses as $course)
                    <a href="{{route('~course.show', $course) }}">
                        <x-badge>
                            {{ $course->name }}
                        </x-badge>
                    </a>
                    @endforeach

                </div>
            </div>
        </div>
    </x-container>
</x-admin-layout>