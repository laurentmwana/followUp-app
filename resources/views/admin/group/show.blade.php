<x-admin-layout title="Plus d'information sur le groupe #{{ $group->id }}">
    <x-container class="py-12">
        <h2 class="text-base font-medium mb-6">
            Plus d'information sur le groupe #{{ $group->id }}
        </h2>


        <div class="space-y-4">
            <div>
                <x-card class="max-w-3xl">
                    <div class="flex items-center gap-2 mb-3">
                        <a href="{{ route('~lmd.index', [
                    'semester' => $group->semester]) }}">
                            <x-badge>
                                {{ $group->semester->name }}
                            </x-badge>
                        </a>
                        <a href="{{ route('~category.index') }}">
                            <x-badge>
                                Categorie : {{ $group->category->name }}
                            </x-badge>
                        </a>
                    </div>
                    <h2 class="mb-2 text-xl">
                        {{ $group->name }}
                    </h2>
                    <p class="text-sm text-muted-foreground mb-4">
                        {{ $group->credits }} crédit(s)
                    </p>

                    @include('shared.ago', [
                    'now' => $group->created_at
                    ])

                </x-card>
            </div>

            <div>
                <h2 class="mb-3 text-xl">
                    Cours
                </h2>
                <div class="flex items-center gap-2">
                    @foreach ($courses as $course)
                    <a href="{{ route('~course.show', $course) }}" class="block">
                        <x-badge>
                            {{ $course->name}}
                        </x-badge>
                    </a>
                    @endforeach
                </div>
            </div>

            <div>
                {{ $courses->links() }}
            </div>
        </div>
    </x-container>
</x-admin-layout>