@foreach ($delibes as $delibe)
@if ($semester->id === $delibe->semester_id)
@foreach ($delibe->deliberateds as $deliberated)
<x-card class="mt-2 border bg-inherit">
    <div class="flex flex-col gap-3">
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Moyenne obtenue de la categorie A :
            </p>
            <p class="text-sm font-light">
                {{ $deliberated->mca }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Moyenne obtenue de la categorie B :
            </p>
            <p class="text-sm font-light">
                {{ $deliberated->mcb }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Moyenne totale du <strong>{{ $semester->name }} :</strong>
            </p>
            <p class="text-sm font-light">
                {{ $deliberated->mab }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Nombre total de crédits :
            </p>
            <p class="text-sm font-light">
                {{ $deliberated->tncc }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Nombre de crédits capitalisées :
            </p>
            <p class="text-sm font-light">
                {{ $deliberated->ncc }}
            </p>
        </div>

        <div class="flex items-center gap-3 justify-between">
            <p class="text-sm font-semibold">
                Mention :
            </p>
            @if ($deliberated->validated === 'NV')
            <div class="bg-red-300 border border-red-600 py-1 px-2 rounded-sm shadow-md">
                <p class="text-sm font-bold">
                    {{ $deliberated->validated }}
                </p>
            </div>

            @else
            <div class="bg-green-300 border border-green-600 py-1 px-2 rounded-sm shadow-md">
                <p class="text-sm font-bold">
                    {{ $deliberated->validated }}
                </p>
            </div>
            @endif

        </div>
    </div>
</x-card>
@endforeach


@endif
@endforeach
