<x-admin-layout title="Ajouter un étudiant">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter un étudiant
        </h2>
        <div class="max-w-lg">
            <x-card>
                @include('admin.student._form', [
                    'student' => $student,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
