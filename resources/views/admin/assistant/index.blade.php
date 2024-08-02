<x-admin-layout title="Gestion des assistants">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">Gestion des assistants</h2>

        @include('shared.searchable', [
            'routeCreate' => route('~assistant.create')
        ])

        <table class="mb-4 w-full caption-bottom text-sm responsive-table">
            <thead class="[&_tr]:border-b">
                <tr
                    class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                >
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        Nom
                    </th>
                    <th
                    class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                >
                    Postnom
                </th>
                <th
                class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
            >
                Sexe
            </th>
                    <th
                    class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                >
                    Cours
                </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        Créer
                    </th>
                </tr>
            </thead>

            <tbody class="[&_tr:last-child]:border-0">
                @foreach ($assistants as $assistant)
                <tr
                    class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                >
                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        <a href="{{ route('~assistant.show', $assistant) }}" class="hover:underline">
                            {{ $assistant->name }}
                        </a>
                    </td>
                    <td
                    class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                >
                    <a href="{{ route('~assistant.show', $assistant) }}" class="hover:underline">
                        {{ $assistant->firstname }}
                    </a>
                </td>

                <td
                class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
            >
                <a href="{{ route('~assistant.show', $assistant) }}" class="hover:underline">
                    {{ $assistant->sex }}
                </a>
            </td>

                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        {{ $assistant->courses()->count() }}
                    </td>
                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        @include('shared.ago', ['now' => $assistant->created_at])
                    </td>

                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        @include('shared.action', [ 'routeEdit' =>
                        route('~assistant.edit', $assistant), 'routeDestroy' =>
                        route('~assistant.destroy', $assistant), ])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $assistants->links() }}
        </div>
    </x-container>
</x-admin-layout>
