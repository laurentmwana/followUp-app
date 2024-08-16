<form onsubmit="return confirm('Voulez-vous vraiment effectuer cette action ?')" class="flex justify-end items-center"
    action="{{ route('~year.closed', $year) }}" method="post">
    @method('PUT')
    @csrf
    <x-primary-button>
        Cloturé
    </x-primary-button>
</form>
