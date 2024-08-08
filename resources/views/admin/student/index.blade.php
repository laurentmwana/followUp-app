<x-admin-layout title="Gestion des étudiants">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">Gestion des étudiants</h2>

        @include('shared.searchable', [
        'routeCreate' => route('~student.create')
        ])

        <table class="mb-4 w-full caption-bottom text-sm responsive-table">
            <thead class="[&_tr]:border-b">
                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Nom
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Postnom
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Promotion
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Créer
                    </th>
                </tr>
            </thead>

            <tbody class="[&_tr:last-child]:border-0">
                @foreach ($students as $student)
                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <a href="{{ route('~student.show', $student) }}" class="hover:underline">
                            {{ $student->name }}
                        </a>
                    </td>
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <a href="{{ route('~student.show', $student) }}" class="hover:underline">
                            {{ $student->firstname }}
                        </a>
                    </td>

                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <a href="{{ route('~student.show', $student) }}" class="hover:underline">
                            {{ $student->levels->count() }}
                        </a>
                    </td>
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        @include('shared.ago', ['now' => $student->created_at])
                    </td>

                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        @include('shared.action', [ 'routeEdit' =>
                        route('~student.edit', $student), 'routeDestroy' =>
                        route('~student.destroy', $student), ])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $students->links() }}
        </div>
    </x-container>
</x-admin-layout>
