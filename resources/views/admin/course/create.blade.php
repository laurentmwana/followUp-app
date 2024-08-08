<x-admin-layout title="Ajouter un cours">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Ajouter un cours
        </h2>
        <div class="w-full">
            @include('admin.course._form', [
            'course' => $course,
            ])
        </div>
    </x-container>
</x-admin-layout>
