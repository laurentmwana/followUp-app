<form class="space-y-4" method="post" action="{{ route('~basic-year', [
'programme' => $programmeId,
]) }}" method="get" onsubmit="return confirm('Voulez-vous vraiment effectuer cette action ?')">
    @csrf

    <div class="mb-2">
        <x-secondary-button type="submit">
            <div class="flex items-center gap-2">
                <i class="bi bi-eye"></i>
                Délibération annuelle pour la <em>"Licence {{ $programmeId }}"</em>
            </div>
        </x-secondary-button>
    </div>
</form>
