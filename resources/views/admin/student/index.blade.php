<x-admin-layout title="Gestion des étudiants">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">Gestion des étudiants</h2>

        @include('shared.searchable', [
        'routeCreate' => route('~student.create')
        ])

        <div class="my-3">
            <x-button-link href="{{ route('~user.index') }}">
                Gestion de compte des étudiants
            </x-button-link>
        </div>


        @include('admin.student.student-table', [
        'students' => $students
        ])

    </x-container>
</x-admin-layout>