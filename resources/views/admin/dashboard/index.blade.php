<x-admin-layout title="Tableau de bord">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-4">
            Tableau de bord
        </h2>

        <div class="mt-4">
            <div class="grid grid-cols-1 lg:xl:grid-cols-3 justify-between gap-3">
                @include('admin.dashboard._card', [
                'count' => $optionCount,
                'title' => $optionCount > 1 ? 'Options' : 'option',
                'route' => route('~option.index'),
                ])
                @include('admin.dashboard._card', [
                'count' => $studentCount,
                'title' => $studentCount > 1 ? 'Etudiants' : 'Etudiant',
                'route' => route('~student.index'),
                ])
                @include('admin.dashboard._card', [
                'count' => $levelCount,
                'title' => $levelCount > 1 ? 'Promotions' : 'Promotion',
                'route' => route('~level.index'),
                ])
            </div>
        </div>
        <div class="mt-4">
            <div class="grid grid-cols-1 lg:xl:grid-cols-3 justify-between gap-3">
                <div class="col-span-2">
                    @include('admin.dashboard._pie', [
                    'delibe' => $delibe,
                    'route' => "",
                    ])
                </div>
                <div class="col-span-1">
                    <div class="mb-4">
                        @include('admin.dashboard._card', [
                        'count' => $courseCount,
                        'title' => 'Nombre total de cours',
                        'route' => route('~course.index'),
                        ])
                    </div>

                    <div>
                        @include('admin.dashboard._card', [
                        'count' => $professorCount,
                        'title' => $professorCount > 1 ? 'Professeurs' : 'Professeur',
                        'route' => route('~professor.index'),
                        ])
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-admin-layout>
