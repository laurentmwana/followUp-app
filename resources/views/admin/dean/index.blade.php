<x-admin-layout title="Gestion des doyens">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">Gestion des doyens</h2>

        @include('shared.searchable', [
            'routeCreate' => route('~dean.create')
        ])

        <table class="mb-4 w-full caption-bottom text-sm responsive-table">
            <thead class="[&_tr]:border-b">
                <tr
                    class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                >
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        Professeur
                    </th>
                    <th
                    class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                >
                    Faculté
                </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        Créer
                    </th>
                </tr>
            </thead>

            <tbody class="[&_tr:last-child]:border-0">
                @foreach ($deans as $dean)
                <tr
                    class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                >
                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        <a href="{{ route('~professor.show', $dean->professor->id) }}" class="hover:underline">
                            {{ $dean->professor->name }}
                        </a>
                    </td>
                    <td
                    class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                >
                    <a href="{{ route('~faculty.show', $dean->faculty->id) }}" class="hover:underline">
                        {{ $dean->faculty->name }}
                    </a>
                </td>
                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        @include('shared.ago', ['now' => $dean->created_at])
                    </td>

                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        @include('shared.action', [ 'routeEdit' =>
                        route('~dean.edit', $dean), 'routeDestroy' =>
                        route('~dean.destroy', $dean), ])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $deans->links() }}
        </div>
    </x-container>
</x-admin-layout>
