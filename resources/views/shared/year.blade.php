@php
$routeName ??= '^vz.index';

$yearId = request()->query->get('year');
@endphp
<div class="flex flex-col gap-2">
    @foreach ($years as $year)
    @if ($year->state === 1)
    <a href="{{ route($routeName, ['year' => $year->id,]) }}"
        class="relative w-full rounded-lg border border-red-200 px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-background text-foreground">
        {{ $year->start }} - {{ $year->end }}
    </a>
    @elseif ($year->state === 0)
    <a title="en cours" href="{{ route($routeName, ['year' => $year->id,]) }}"
        class="relative w-full rounded-lg border border-indigo-500 px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-background text-foreground">
        {{ $year->start }} - {{ $year->end }}
    </a>
    @else
    <a href="{{ route($routeName, ['year' => $year->id,]) }}"
        class="relative w-full rounded-lg border px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-background text-foreground @if($yearId == $year->id) border-gray-700 @endif">
        {{ $year->start }} - {{ $year->end }}
    </a>
    @endif
    @endforeach
</div>

{{ $years->links() }}
