<form method="post" action="{{ route('~basic', [
'programme' => $programmeId,
'semester' => $semesterId,
'delibe' => 'basic'
]) }}" method="get" onsubmit="return confirm('Voulez-vous vraiment effectuer cette action ?')">
    @csrf
    <x-secondary-button type="submit">
        <div class="flex items-center gap-2">
            <i class="bi bi-eye"></i>
            Délibération pour la <em>"Licence {{ $programmeId }} Semestre {{ $semesterId }}"</em>
        </div>
    </x-secondary-button>
</form>
