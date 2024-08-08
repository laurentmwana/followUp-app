@php
$levels = \App\Models\Level::with(['programme', 'option', 'year'])->get();

$levelId = request()->query->get('level');

@endphp
<form action="{{ route('dashboard') }}" method="get" class="flex items-center gap-2 justify-end">
    <x-select required :items="formatLevelToProgramme($levels)" value="{{ old('level', $levelId) }}" id="level"
        name="level" placeholder="Promotion" />
    <x-primary-button>
        <i class="bi bi-filter"></i>
    </x-primary-button>
</form>
