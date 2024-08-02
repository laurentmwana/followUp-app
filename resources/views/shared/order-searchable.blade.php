@php
    $collection ??= [];
    $label ??= 'name';
    $id ??= 'id';
@endphp

<div class="flex items-center justify-between gap-2 mb-6">
    <div class="flex items-center gap-x-3">
        <div>

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <x-secondary-button>
            <i class="bi bi-filter"></i>
        </x-secondary-button>
    </x-slot>

    <x-slot name="content">
        @foreach ($collection as $item)
        <x-dropdown-link href="">
            {{ $item[$label] }}
        </x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>

        </div>
        @include('shared.search')
    </div>
    <div>
        <x-button-link  href="{{ $routeCreate }}">
                <i class="bi bi-plus"></i>
        </x-button-link>
    </div>
</div>

@include('shared.flash')
