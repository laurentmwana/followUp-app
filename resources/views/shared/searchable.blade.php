<div class="flex items-center justify-between gap-2 mb-6">
    <div>@include('shared.search')</div>
    <div>
        <x-button-link  href="{{ $routeCreate }}">
                <i class="bi bi-plus"></i>
        </x-button-link>
    </div>
</div>

@include('shared.flash')
