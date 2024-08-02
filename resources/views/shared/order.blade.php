@php
    $path ??= ""
@endphp

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <x-secondary-button>
            <i class="bi bi-filter"></i>
        </x-secondary-button>
    </x-slot>

    <x-slot name="content">
        @foreach ($collection as $key => $value)
        <x-dropdown-link href="">
            {{ $value }}
        </x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>
