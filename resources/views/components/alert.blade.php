@php
$variants = [
'error' => "border-destructive/50 text-destructive dark:border-destructive [&>svg]:text-destructive",
"default" => "bg-background text-foreground",
];

$variant ??= 'default';
@endphp

<div class="max-w-lg">
    <div
        class="relative w-full rounded-lg border px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-background text-foreground">
        <div @class([$variants[$variant]])>
            {{ $slot }}
        </div>
    </div>
</div>
