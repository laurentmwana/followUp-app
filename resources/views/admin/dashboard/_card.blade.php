@php
$count ??= 0;
$title ??= "";
$route ??= "";

@endphp

@if (!empty($route))
<a href="{{ $route }}" class="block w-full">
    <x-card class="bg-inherit hover:border-green-600">
        <h5 class="text-2xl font-semibold text-gray-900 dark:text-gray-300 mb-2">
            {{ formatNumber($count) }}
        </h5>

        <p class="text-[13px] text-muted-foreground font-normal">
            {{ $title }}
        </p>
    </x-card>
</a>
@else

<x-card class="bg-inherit">
    <h5 class="text-2xl font-semibold text-gray-900 dark:text-gray-300 mb-2">
        {{ formatNumber($count) }}
    </h5>

    <p class="text-[13px] text-muted-foreground font-normal">
        {{ $title }}
    </p>
</x-card>

@endif
