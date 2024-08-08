<x-admin-layout title="Programme">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">Programme</h2>

        @foreach ($programmes as $programme)
        <x-card class="mb-5 bg-inherit rounded-lg">
            <h2 class="text-xl font-semibold mb-3">
                {{ $programme->name }} ~ {{ $programme->alias }}
            </h2>
            <table class="mb-4 w-full caption-bottom text-sm responsive-table">
                <thead class="[&_tr]:border-b">
                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <th
                            class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            Semestre
                        </th>
                        <th
                            class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            Alias
                        </th>
                        <th
                            class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            Créer
                        </th>
                    </tr>
                </thead>

                <tbody class="[&_tr:last-child]:border-0">
                    @foreach ($programme->semesters as $semester)
                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <td
                            class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            {{ $semester->name }}
                        </td>
                        <td
                            class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            {{ $semester->alias }}
                        </td>

                        <td
                            class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            @include('shared.ago', ['now' => $semester->created_at])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
        @endforeach
    </x-container>
</x-admin-layout>
