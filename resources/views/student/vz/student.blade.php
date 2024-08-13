<div class="flex flex-col gap-3">
    <x-card>
        <div class="flex items-center justify-between gap-3">
            <h2 class="text-base font-semibold text-gray-700 dark:text-muted-foreground mb-2">
                {{ $student->name }} {{ $student->firstname }}
            </h2>

            <div>
                #{{ $student->id }}
            </div>
        </div>
    </x-card>

    @foreach ($student->levels as $level)
    <x-card class="bg-inherit mb-2">
        <h2 class="text-base font-semibold text-gray-700 dark:text-muted-foreground mb-2">
            {{ $level->programme->name }} ~ {{ $level->year->start }} -
            {{ $level->year->end }}
        </h2>
        <p class="text-sm text-muted-foreground">
            {{ $level->option->name }}
        </p>
    </x-card>

    @foreach ($level->programme->semesters as $semester)
    <div>
        <h2 class="mb-2">
            {{ $semester->name }}
        </h2>
    </div>

    @foreach ($semester->groups as $group) @if ($group->notes->count() > 0)

    <div class="flex items-center justify-between text-sm text-muted-foreground">
        <div>
            {{ $group->name }}
        </div>
        <div>
            {{ $group->category->name }}
        </div>
    </div>

    <table class="mb-4 w-full caption-bottom text-sm responsive-table">
        <thead class="[&_tr]:border-b">
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                <th
                    class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                    Course
                </th>
                <th
                    class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                    Crédits
                </th>
                <th
                    class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                    Cote Obtenue
                </th>
                <th
                    class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                </th>
            </tr>
        </thead>

        <tbody class="[&_tr:last-child]:border-0">
            @foreach ($group->notes as $note)
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                    <a href="" class="hover:underline">
                        {{ $note->course->name }}
                    </a>
                </td>
                <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                    {{ $note->course->credits }}
                </td>

                <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                    @if (okNote($note->note))
                    <span class="text-green-500">
                        {{ $note->note }}
                    </span>
                    @else
                    <span class="text-red-500">
                        {{ $note->note }}
                    </span>
                    @endif
                    /20
                </td>
                <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                    @php
                    $tnp = $note->course->credits * 20;
                    @endphp
                    @if (okNote($note->np, $tnp / 2, $tnp))
                    <span class="text-green-500">
                        {{ $note->np }}
                    </span>
                    @else
                    <span class="text-red-500">
                        {{ $note->np }}
                    </span>
                    @endif
                    / {{ $tnp }}
                </td>
            </tr>
            @endforeach

            @include('student.vz.total', [
            'notes' => $group->notes,
            ])
        </tbody>
    </table>

    @endif
    @endforeach

    @include('student.vz.delibe', [
    'delibes' => $semester->deliberations,
    'semesterId' => $semester,
    ])




    @include('shared.separator', [
    'class' => 'my-3'
    ])

    @endforeach

    @include('student.vz.annual', [
    'annuals' => $level->annuals,
    'level' => $level,
    'student' => $student,
    ])



    @endforeach
</div>
