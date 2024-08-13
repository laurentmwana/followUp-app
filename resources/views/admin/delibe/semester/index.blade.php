<x-admin-layout title="Déliberation Semestrielle">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">Déliberation Semestrielle</h2>

        @include('shared.flash')

        <div class="flex justify-between gap-4 my-4">
            <div>
                <x-button-link href="{{ route('~delibe.annual.index') }}">
                    Délibération annuelle
                </x-button-link>
            </div>
            <x-button-link href="{{ route('~delibe.new', ['programme' => 1]) }}">
                Effectuer une délibération
            </x-button-link>
        </div>

        <table class="mb-4 w-full caption-bottom text-sm responsive-table">
            <thead class="[&_tr]:border-b">
                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Promotion
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Année academique
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Semestre
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Nombre d'étudiants
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Procès-verbal (PV)
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Créer
                    </th>
                </tr>
            </thead>

            <tbody class="[&_tr:last-child]:border-0">
                @foreach ($deliberations as $deliberation)
                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <a href="{{ route('~delibe.show', $deliberation) }}" class="hover:underline">
                            {{ $deliberation->level->programme->name }} {{ $deliberation->level->option->alias }}
                        </a>
                    </td>
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <a href="{{ route('~delibe.show', $deliberation) }}" class="hover:underline">
                            {{ $deliberation->year->start }}-{{ $deliberation->year->end }}
                        </a>
                    </td>
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <a href="{{ route('~lmd.index', [
                        'programme' => $deliberation->semester->programme_id,
                        ]) }}" class="hover:underline">
                            {{ $deliberation->semester->name }}
                        </a>
                    </td>
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <a href="{{ route('~delibe.show', $deliberation) }}" class="hover:underline">
                            {{ $deliberation->deliberateds->count() }} / {{ $deliberation->level->students->count() }}
                        </a>
                    </td>
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        @if ($deliberation->pv !== null)
                        <x-badge type="success">
                            Oui
                        </x-badge>
                        @else
                        <x-badge type="destructive">
                            Non
                        </x-badge>
                        @endif
                    </td>
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        @include('shared.ago', ['now' => $deliberation->created_at])
                    </td>

                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <div class="flex gap-2 items-center">
                            <x-button-link variant='default' href="{{ route('~delibe.pv', $deliberation) }}">
                                Procès-verbal
                            </x-button-link>
                            <x-button-link href="{{ route('~delibe.show', $deliberation) }}">
                                Voir
                            </x-button-link>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $deliberations->links() }}
        </div>
    </x-container>
</x-admin-layout>
