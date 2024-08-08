@php

$delibe ??= false;

@endphp
<x-card class="bg-inherit">
    <div class="flex items-center justify-between gap-4 mb-4">
        <h5 class="text-base font-medium text-muted-foreground">
            Statistique des délibérations
        </h5>

        <div class="max-w-sm">
            @include('admin.dashboard._form')
        </div>
    </div>


    @if (is_string($delibe))
    <div id="piechart" class="max-w-lg" data-piechart="{{ $delibe }}">
    </div>
    @else

    <p class="text-sm text-muted-foreground">
        Aucune délibération trouvée...
    </p>
    @endif
</x-card>
