@php
$programmeId = request()->query->get('programme', $programmeId);
$semesterId = request()->query->get('semester', $semesterId);
$generate = request()->query->get('generate', false);

$programmes = \App\Models\Programme::pluck('name', 'id');


$semesters = \App\Models\Semester::whereProgrammeId($programmeId)
->pluck('name', 'id');

@endphp

<div class="flex items-center justify-between gap-3">
    <div>
        @if (!$generate)
        <form action="" class="flex items-center justify-start gap-2">
            <div>
                <x-select :items="$programmes" id="programme" name="programme"
                    value="{{ old('programme', $programmeId) }}" placeholder="Programme" />
            </div>

            @if ($programmeId !== null)
            <div>
                <x-select :items="$semesters" id="semester" name="semester" value="{{ old('semester', $semesterId) }}"
                    placeholder="Semestre" />
            </div>
            @endif
            <x-primary-button>
                <i class="bi bi-filter"></i>
            </x-primary-button>
        </form>
        @endif
    </div>

    {{-- <form action="{{ route('^pdf.index', [
    'programme' => $programmeId,
    'semester' => $semesterId,
    'generate' => true,
    ]) }}" class="flex items-center justify-end gap-2">
        <input type="hidden" name="generate" value="1">

        <x-secondary-button type="submit">
            <i class="bi bi-printer"></i>
        </x-secondary-button>
    </form> --}}

    <div>
        <x-secondary-button type="button" onclick="return window.print()">
            <i class="bi bi-printer"></i>
        </x-secondary-button>
    </div>
</div>
