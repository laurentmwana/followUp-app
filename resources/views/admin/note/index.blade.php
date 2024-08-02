<x-admin-layout title="Gestion de cotes">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">Gestion de cotes</h2>

        @include('shared.searchable', [
            'routeCreate' => route('~note.create')
        ])



        <table class="mb-4 w-full caption-bottom text-sm responsive-table">
            <thead class="[&_tr]:border-b">
                <tr
                    class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                >
                <th
                class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
            >
                Note
            </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        Etudiant
                    </th>
                    <th
                    class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                >
                    Cours
                </th>
                    <th
                    class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                >
                    Semester
                </th>

                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        Créer
                    </th>
                </tr>
            </thead>

            <tbody class="[&_tr:last-child]:border-0">
                @foreach ($notes as $note)
                <tr
                    class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                >
                <td
                class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
            >
                <a href="{{ route('~note.show', $note) }}" class="hover:underline">
                    {{ $note->note }}
                </a>
            </td>
                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        <a href="{{ route('~student.show', $note->student->id) }}" class="hover:underline">
                            {{ $note->student->name }}
                        </a>
                    </td>
                    <td
                    class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                >
                    <a href="{{ route('~course.show', $note->course->id) }}" class="hover:underline">
                        {{ $note->course->name }}
                    </a>
                </td>

                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        {{ $note->semester->name }}
                    </td>


                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        @include('shared.ago', ['now' => $note->created_at])
                    </td>

                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        @include('shared.action', [ 'routeEdit' =>
                        route('~note.edit', $note), 'routeDestroy' =>
                        route('~note.destroy', $note), ])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $notes->links() }}
        </div>
    </x-container>
</x-admin-layout>
