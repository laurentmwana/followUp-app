@php
    $routeName ??= '^vz.index';

    $programmeId = request()->query->get('programme');
@endphp
<div class="flex flex-col gap-2">
    @foreach ($programmes as $programme)
    @if ($programmeId == $programme->id)
    <a  href="{{ route($routeName, ['programme' => $programme->id,]) }}" class="relative w-full rounded-lg border border-indigo-500 px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-background text-foreground">
        {{ $programme->name }}
    </a>
    @else
    <a href="{{ route($routeName, ['programme' => $programme->id,]) }}" class="relative w-full rounded-lg border px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-background text-foreground">
        {{ $programme->name }}
    </a>
    @endif
    @endforeach
</div>
