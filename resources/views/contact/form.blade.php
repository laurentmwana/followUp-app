<x-card>
    <form class="space-y-4" action="{{route('contact.store')}}" method="post">
        @csrf

        <div>
            <x-input-label for="name">Nom</x-input-label>
            <x-text-input value="{{ old('name') }}" id="name" name="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email">Adresse e-mail</x-input-label>
            <x-text-input type="email" value="{{ old('email') }}" id="email" name="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="subject">Sujet</x-input-label>
            <x-text-input value="{{ old('subject') }}" id="subject" name="subject" />
            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="message">Message</x-input-label>
            <x-textarea value="{{ old('message') }}" id="message" name="message" />
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <x-primary-button>
            <i class="bi bi-envelope"></i>
        </x-primary-button>
    </form>

</x-card>
