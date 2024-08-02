<form class="space-y-4" action="{{ $faculty->id ? route('~faculty.update', $faculty) : route('~faculty.store') }}" method="post">

    @if($faculty->id)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $faculty->id }}">
    @endif
    @csrf

    <div>
        <x-input-label for="name">Nom de la faculté</x-input-label>
        <x-text-input value="{{ $faculty->id ? $faculty->name : old('name') }}" id="name" name="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <x-primary-button>
        <i class="bi {{ $faculty->id ? 'bi-pen' : 'bi-plus' }}"></i>
    </x-primary-button>
</form>
