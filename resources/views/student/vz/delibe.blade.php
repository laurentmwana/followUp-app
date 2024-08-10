@foreach ($delibes as $delibe)
@if ($semester->id === $delibe->semester_id)
<x-card class="mt-2 border bg-inherit">
    <div class="flex flex-col gap-3">
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Moyenne obtenue de la categorie A :
            </p>
            <p class="text-sm font-light">
                {{ $delibe->mca }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Moyenne obtenue de la categorie B :
            </p>
            <p class="text-sm font-light">
                {{ $delibe->mcb }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Moyenne totale du <strong>{{ $semester->name }} :</strong>
            </p>
            <p class="text-sm font-light">
                {{ $delibe->mab }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <p class="text-sm font-semibold">
                Pourcentage :
            </p>
            <p class="text-sm font-light">
                {{ $delibe->pourcent }}%
            </p>
        </div>
    </div>
</x-card>
@endif
@endforeach
