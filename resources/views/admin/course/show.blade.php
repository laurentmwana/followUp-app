<x-admin-layout title="Plus d'information sur le cours #{{ $course->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Plus d'information sur le cours #{{ $course->id }}
        </h2>


        <x-card class="max-w-3xl">

            <div class="flex items-center gap-3 mb-3">
                <p class="text-sm text-muted-foreground">Nom du cours : </p>
                <p class="text-sm text-muted-foreground">
                    {{ $course->name }}
                </p>
            </div>
            <div class="flex items-center gap-3 mb-3">
                <p class="text-sm text-muted-foreground">Semestre : </p>
                <p class="text-sm text-muted-foreground">
                    <a href="" class="hover:underline">
                        {{ $course->semester->name }}
                    </a>
                </p>
            </div>
            <div class="flex items-center gap-3 mb-3">
                <p class="text-sm text-muted-foreground">Crédits : </p>
                <p class="text-sm text-muted-foreground">
                    {{ $course->credits }}
                </p>
            </div>
            <div class="flex items-center gap-3 mb-3">
                <p class="text-sm text-muted-foreground">Groupe : </p>
                <p class="text-sm text-muted-foreground">
                    <a href="{{ route('~group.show', $course->group) }}" class="hover:underline">
                        {{ $course->group->name }} | {{ $course->group->credits }} crédit(s)
                    </a>
                </p>
            </div>

            <div class="flex items-center gap-3 mb-3">
                <p class="text-sm text-muted-foreground">Professeur : </p>
                <p class="text-sm text-muted-foreground">
                    <a href="{{ route('~professor.show', $course->professor) }}" class="hover:underline">
                        {{ $course->professor->name }} {{ $course->professor->firstname }}
                    </a>
                </p>
            </div>

            <div class="flex items-center gap-3 mb-3">
                <p class="text-sm text-muted-foreground">Enregistrer : </p>
                @include('shared.ago', [
                'now' => $course->created_at
                ])
            </div>
        </x-card>
    </x-container>
</x-admin-layout>