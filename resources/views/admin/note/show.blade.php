<x-admin-layout title="Plus d'information sur la note #{{ $note->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Plus d'information sur la note #{{ $note->id }}
        </h2>

        <div>
            <x-card class="max-w-3xl">

                <div class="flex items-center gap-y-4 gap-x-2 flex-wrap mb-3">
                    <a href="{{ route('~year.show', $note->year) }}">
                        <x-badge>
                            {{ $note->year->start}}-{{ $note->year->end}}
                        </x-badge>
                    </a>
                    <a href="{{ route('~lmd.index', [
                    'semester' => $note->semester->id
                    
                    ]) }}">
                        <x-badge>
                            {{ $note->semester->name}}
                        </x-badge>
                    </a>

                    <a href="{{ route('~group.show', $note->group) }}">
                        <x-badge>
                            {{ $note->group->name}}
                        </x-badge>
                    </a>
                </div>

                <h1 class="font-semibold mb-3">
                    {{ $note->student->name }} {{ $note->student->firstname }}
                </h1>


                <div class="flex items-center gap-2 mb-2">
                    <p class="text-sm text-muted-foreground">Note : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $note->note }} / 20
                    </p>
                </div>
                <div class="flex items-center gap-2 mb-2">
                    <p class="text-sm text-muted-foreground">Note pondérée : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $note->np }} / {{ 20 * $note->course->credits }}
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="text-sm text-muted-foreground">Reussite : </p>
                    <p class="text-sm text-muted-foreground">
                        @include('shared.badge', [
                        'active' => ($note->note >= 10 && $note->note <= 20) ? 'success' : 'fail' ]) </p>
                </div>
            </x-card>
        </div>
    </x-container>
</x-admin-layout>