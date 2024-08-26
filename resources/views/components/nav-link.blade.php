@php
$indexer ??= null;
$active ??= null;
@endphp

@if($active !== null && $active === true)
<a {{ $attributes->merge(['class' => "transition-colors hover:text-green-300 text-green-600"]) }}>
    {{ $slot }}
</a>
@elseif(null !== $indexer && Str::contains(request()->getPathInfo(), $indexer))
<a {{ $attributes->merge(['class' => "transition-colors hover:text-green-300 text-green-600"]) }}>
    {{ $slot }}
</a>
@else
<a {{ $attributes->merge(['class' => 'transition-colors hover:text-foreground/80 text-foreground/60']) }}>
    {{ $slot }}
</a>
@endif
