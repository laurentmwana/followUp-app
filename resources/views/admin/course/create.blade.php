<x-admin-layout title="Ajouter un cours">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter un cours
        </h2>
        <div class="max-w-lg">
            <x-card>
                @include('admin.course._form', [
                    'course' => $course,
                ])
            </x-card>
           </div>
    </x-container>
</x-admin-layout>
