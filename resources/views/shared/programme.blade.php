@php
$routeName ??= '^vz.index';

$programmeId = request()->query->get('programme');
$semesterId = request()->query->get('semester');


@endphp
<div class="flex flex-col gap-2">
    @foreach ($programmes as $programme)
    @if ($programmeId == $programme->id)
    <div class="flex items-start gap-2">
        <a href="{{ route($routeName, ['programme' => $programme->id,]) }}"
            class="relative w-full rounded-lg border border-indigo-500 px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-background text-foreground">
            {{ $programme->name }}
        </a>
        <div class="flex items-center justify-center gap-3">
            @foreach ($programme->semesters as $semester)

            @if ($semesterId == $semester->id)
            <a href="{{ route($routeName, ['programme' => $programme->id, 'semester' => $semester->id]) }}"
                class="relative w-full rounded-lg border border-indigo-300 px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-indigo-500 text-gray-50 dark: text-gray-700">
                {{ $semester->alias }}
            </a>
            @else
            <a href="{{ route($routeName, ['programme' => $programme->id, 'semester' => $semester->id]) }}"
                class="relative w-full rounded-lg border px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-background text-foreground">
                {{ $semester->alias }}
            </a>
            @endif
            @endforeach
        </div>
    </div>
    @else
    <a href="{{ route($routeName, ['programme' => $programme->id,]) }}"
        class="relative w-full rounded-lg border px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-background text-foreground">
        {{ $programme->name }}
    </a>
    @endif
    @endforeach
</div>
