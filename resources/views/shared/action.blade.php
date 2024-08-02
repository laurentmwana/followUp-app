<div class="flex items-center justify-end gap-3">
    <form action="{{ $routeDestroy }}" method="post" onsubmit="return confirm('Voulez-vous vraiment effectuerc cette action ?')">
        @method('DELETE')
        @csrf
        <x-danger-button>
            <i class="bi bi-trash"></i>
        </x-danger-button>
    </form>
    <x-button-link variant="secondary" href="{{ $routeEdit }}">
        <i class="bi bi-pen"></i>
    </x-button-link>
</div>
