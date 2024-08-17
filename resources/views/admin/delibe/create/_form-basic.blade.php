<form method="post" action="{{ route('~semester')}}" method="post"
    onsubmit="return confirm('Voulez-vous vraiment effectuer cette action ?')">
    @csrf
    <input type="hidden" name="semester" value="{{ $semesterId }}">
    <input type="hidden" name="programme" value="{{ $programmeId }}">
    <input type="hidden" name="option_id" value="1">

    <x-secondary-button type="submit">
        <div class="flex items-center gap-2">
            <i class="bi bi-eye"></i>
            Délibération pour la <em>"Licence {{ $programmeId }} Semestre {{ $semesterId }}"</em>
        </div>
    </x-secondary-button>
</form>
