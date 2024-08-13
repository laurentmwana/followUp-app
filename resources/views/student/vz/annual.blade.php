<div>
    <h2 class="mb-2">
        Annuel
    </h2>
</div>
@foreach ($annuals as $annual)
@foreach ($annual->deliberateds as $deliberated)
<x-card>
    <div class="flex flex-col gap-3">
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Moyenne annuelle obtenue de la categorie A :
            </p>
            <p class="text-sm font-light">
                {{ $deliberated->mca }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Moyenne annuelle obtenue de la categorie B :
            </p>
            <p class="text-sm font-light">
                {{ $deliberated->mcb }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Moyenne annuelle de categorie :
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
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Nombre de crédits à refaire :
            </p>
            <p class="text-sm font-light">
                {{ $deliberated->tncc - $deliberated->ncc }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Pourcentage :
            </p>
            <p class="text-sm text-indigo-800 font-bold">
                {{ $deliberated->pourcent }}%
            </p>
        </div>
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Mention :
            </p>
            <p class="text-sm text-indigo-800 font-bold">
                {{ $deliberated->validated }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <p class="text-sm font-light">
                Décision :
            </p>
            <p class="text-sm text-indigo-800 font-bold">
                {{ $deliberated->decision }}
            </p>
        </div>
    </div>


</x-card>
@endforeach
@endforeach
