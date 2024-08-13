<x-admin-layout title="Déliberation annuelle">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">Déliberation annuelle</h2>

        @include('shared.flash')

        <div class="flex justify-between gap-4 my-4">

            <div>

            </div>
            <x-button-link href="{{ route('~delibe.new', ['programme' => 1]) }}">
                Effectuer une délibération annuelle
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
                        Nombre d'étudiants
                    </th>
                    <th
                        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        Créer
                    </th>
                </tr>
            </thead>

            <tbody class="[&_tr:last-child]:border-0">
                @foreach ($annuals as $annual)
                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <a href="{{ route('~delibe.show', $annual) }}" class="hover:underline">
                            {{ $annual->level->programme->name }} {{ $annual->level->option->alias }}
                        </a>
                    </td>
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <a href="{{ route('~delibe.show', $annual) }}" class="hover:underline">
                            {{ $annual->year->start }}-{{ $annual->year->end }}
                        </a>
                    </td>
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        <a href="{{ route('~delibe.show', $annual) }}" class="hover:underline">
                            {{ $annual->deliberateds->count() }} / {{ $annual->level->students->count() }}
                        </a>
                    </td>
                    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                        @include('shared.ago', ['now' => $annual->created_at])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $annuals->links() }}
        </div>
    </x-container>
</x-admin-layout>
