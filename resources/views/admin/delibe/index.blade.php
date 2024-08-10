@php
$semesterId = request()->query->get('semester');
$programmeId = request()->query->get('programme');
@endphp

<x-admin-layout title="Gestion des utilisateurs">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Délibération
        </h2>

        <div>
            <div class="flex gap-4 flex-wrap w-ful">
                <div>
                    @include('shared.programme', [
                    'routeName' => '~delibe.index'
                    ])
                </div>

                <div class="sm:w-full lg:max-w-lg">
                    <div class="bg-inherit">
                        @if ($programmeId === '1' && ($semesterId === '1' || $semesterId === '2'))
                        @include('admin.delibe._form-delibe-basic', [
                        'programmeId' => $programmeId,
                        'semesterId' => $semesterId
                        ])

                        @else

                        <p class="text-muted-foregroup text-sm">
                            Selectionner la promotion et le semestre que vous souhaitez délibérer...
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-admin-layout>
