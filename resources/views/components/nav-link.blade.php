
@php
    $indexer ??= null;
    $active ??= null;
@endphp

@if($active !== null && $active === true)
<a {{ $attributes->merge(['class' => "transition-colors hover:text-indigo-300 text-indigo-600"]) }}>
    {{ $slot }}
</a>
@elseif(null !== $indexer && Str::contains(request()->getPathInfo(), $indexer))
<a {{ $attributes->merge(['class' => "transition-colors hover:text-indigo-300 text-indigo-600"]) }}>
    {{ $slot }}
</a>
@else
<a {{ $attributes->merge(['class' => 'transition-colors hover:text-foreground/80 text-foreground/60']) }}>
    {{ $slot }}
</a>
@endif
