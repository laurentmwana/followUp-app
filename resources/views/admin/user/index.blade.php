<x-admin-layout title="Gestion des utilisateurs">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">Gestion des utilisateurs</h2>

        @include('shared.searchable', [ 'routeCreate' => route('~user.create')
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
                        Email
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        Etudiant
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        Email vérifié
                    </th>

                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        Créer
                    </th>
                </tr>
            </thead>

            <tbody class="[&_tr:last-child]:border-0">
                @foreach ($users as $user)
                <tr
                    class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                >
                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        <a
                            href="{{ route('~user.show', $user) }}"
                            class="hover:underline"
                        >
                            {{ $user->name }}
                        </a>
                    </td>
                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        {{ $user->email }}
                    </td>
                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        <a
                            href="{{ route('~student.show', $user->student->id) }}"
                            class="hover:underline"
                        >
                            {{ $user->student->name }}
                        </a>
                    </td>

                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                    @include('shared.badge', [
                        'active' => $user->email_verified_at !== null
                    ])
                    </td>

                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        @include('shared.ago', ['now' => $user->created_at])
                    </td>

                    <td
                        class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]"
                    >
                        @include('shared.action', [ 'routeEdit' =>
                        route('~user.edit', $user), 'routeDestroy' =>
                        route('~user.destroy', $user), ])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $users->links() }}
        </div>
    </x-container>
</x-admin-layout>
