<x-base-layout title="Mon profil">

    <x-container class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-card class="bg-inherit">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </x-card>

            <x-card class="bg-inherit">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </x-card>
        </div>
    </x-container>
</x-base-layout>
