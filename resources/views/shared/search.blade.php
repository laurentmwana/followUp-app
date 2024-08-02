@php

$value = request()->query->get('query');

@endphp

<form action="">
    <div class="flex items-center gap-2">
        <x-text-input
        name="query"
        id="query"
        required
        placeholder="{{ $placeholder ?? 'Faire une recherche'  }}"
        value="{{$value}}"/>

        @if(null === $value && @empty($value))
        <x-primary-button>
            <i class="bi bi-search"></i>
        </x-primary-button>
        @else
        <x-secondary-button type="button">
            <a href="{{ request()->getPathInfo() }}">
                <i class="bi bi-x"></i>
            </a>
        </x-secondary-button>
        @endif

    </div>
</form>
