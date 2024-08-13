<x-admin-layout title=" Plus d'informaion sur la délibération annuelle #{{ $annual->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Plus d'informaion sur la délibération annuelle #{{ $annual->id }}
        </h2>

        <div class="my-3 max-w-4xl">
            <x-card>
                <h2 class="text-2xl font-semibold mb-2">
                    {{ $annual->level->programme->name }}
                </h2>

                <p class="text-sm text-muted-foreground mb-2">
                    {{ $annual->level->option->name }}
                </p>
                <p class="text-sm text-muted-foreground mb-2">
                    {{ $annual->year->start }}-{{ $annual->year->end }}
                </p>
            </x-card>
        </div>

        <div class="mt-4">
            <h2 class="text-base font-medium mb-6">
                {{ Str::camel("étudiants") }}
            </h2>

            <table class="mb-4 w-full caption-bottom text-sm responsive-table">
                <thead class="[&_tr]:border-b">
                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <th
                            class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            Etudiant
                        </th>
                        <th
                            class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            Pourcentage
                        </th>
                        <th
                            class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            Moyenne categorie A
                        </th>
                        <th
                            class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            Moyenne categorie B
                        </th>
                        <th
                            class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            Moyenne categorie
                        </th>
                        <th
                            class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            Créer
                        </th>
                    </tr>
                </thead>

                <tbody class="[&_tr:last-child]:border-0">
                    @foreach ($deliberateds as $deliberated)
                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <td
                            class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            <a href="{{ route('~student.show', $deliberated->student) }}" class="hover:underline">
                                {{ $deliberated->student->name }} {{ $deliberated->student->firstname }}
                            </a>
                        </td>
                        <td
                            class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            {{ $deliberated->pourcent }}
                        </td>
                        <td
                            class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            {{ $deliberated->mca }}
                        </td>
                        <td
                            class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            {{ $deliberated->mcb }}
                        </td>
                        <td
                            class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            {{ $deliberated->mab }}
                        </td>
                        <td
                            class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
                            @include('shared.ago', ['now' => $deliberated->created_at])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                {{ $deliberateds->links() }}
            </div>
        </div>
    </x-container>
</x-admin-layout>
