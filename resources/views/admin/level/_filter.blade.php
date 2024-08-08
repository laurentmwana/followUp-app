@php
$programmes = \App\Models\Programme::all();

$programmeId = request()->query->get('programme');

@endphp
<form action="{{ route('~level.index') }}" method="get" class="flex items-center gap-2 justify-end">
    <x-select required :items="formatProgramme($programmes)" value="{{ old('programme', $programmeId) }}" id="programme"
        name="programme" placeholder="Promotion" />
    <x-primary-button>
        <i class="bi bi-filter"></i>
    </x-primary-button>
</form>
