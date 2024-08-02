@php
    $avatar = Str::upper(Str::limit($name, 2, ''));
@endphp

<div class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full cursor-pointer">
    <div class="flex h-full w-full items-center justify-center rounded-full bg-muted">
        {{ $avatar }}
    </div>
</div>
