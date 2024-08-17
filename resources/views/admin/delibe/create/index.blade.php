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
            <div class="flex gap-6 flex-wrap w-ful">
                <div>
                    @include('shared.programme', [
                    'routeName' => '~delibe.new'
                    ])
                </div>

                <div class="sm:w-full lg:max-w-lg">
                    <div class="mb-2">

                    </div>
                    <div class="bg-inherit">
                        @if ($programmeId === '1' && ($semesterId === '1' || $semesterId === '2'))
                        @include('admin.delibe.create._form-basic', [
                        'programmeId' => $programmeId,
                        'semesterId' => $semesterId
                        ])

                        @elseif($programmeId === '1' && ($semesterId === null || $semesterId === ''))
                        @include('admin.delibe.create._form-basic-year', [
                        'programmeId' => $programmeId,
                        ])

                        @elseif($programmeId === '2' && ($semesterId === '3' || $semesterId === '4'))
                        @include('admin.delibe.create._form-classic', [
                        'programmeId' => $programmeId,
                        ])

                        @elseif($programmeId === '2' && ($semesterId === null || $semesterId === ''))
                        @include('admin.delibe.create._form-classic-year', [
                        'programmeId' => $programmeId,
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
