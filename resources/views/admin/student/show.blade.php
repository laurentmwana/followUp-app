<x-admin-layout title="Plus d'information sur l'étudiant #{{ $student->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Plus d'information sur l'étudiant #{{ $student->id }}
        </h2>


        <div class="max-w-3xl space-y-5">


            <x-card>
                <h2 class="text-base font-semibold text-gray-800 dark:text-gray-100 mb-4">
                    Information personnelle
                </h2>
                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Nom de l'étudiant : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $student->name }}
                    </p>
                </div>
                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Postnom de l'étudiant : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $student->firstname }}
                    </p>
                </div>
                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Genre : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $student->sex }}
                    </p>
                </div>
                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Numéro de téléphone : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $student->phone }}
                    </p>
                </div>

                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Date de naissance : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $student->happy }} ~ {{ age($student->happy) }}
                    </p>
                </div>

                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Enregistrer : </p>
                    @include('shared.ago', [
                    'now' => $student->created_at
                    ])
                </div>
            </x-card>


            <x-card>
                <h2 class="text-base font-semibold text-gray-800 dark:text-gray-100 mb-4">
                    Aunthentification
                </h2>

                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Nom : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $user->name }}
                    </p>
                </div>
                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Adresse e-mail : </p>
                    <p class="text-sm text-muted-foreground">
                        {{ $user->email }}
                    </p>
                </div>


                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Rôle : </p>
                    <p class="text-sm text-muted-foreground">
                        <x-badge>
                            Student
                        </x-badge>
                    </p>
                </div>

                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Mot de passe : </p>
                    <p class="text-sm text-muted-foreground">
                        *************
                    </p>
                </div>

                <div class="flex items-center gap-3 mb-3">
                    <p class="text-sm text-muted-foreground">Enregistrer : </p>
                    @include('shared.ago', [
                    'now' => $user->created_at
                    ])
                </div>
            </x-card>
        </div>
    </x-container>
</x-admin-layout>