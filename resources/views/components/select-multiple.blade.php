@props(['disabled' => false, 'items' => [], 'value' => null, 'placeholder' => ''])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '"flex h-15 w-full rounded-md border
    border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent
    file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1
    focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50",
    ']) !!} multiple tom-select-target>

    <option value="">
        {{ $placeholder }}
    </option>

    @foreach ($items as $k => $v)

    @if (is_string($value))
    <option value="{{ $k }}" @selected($k==$value)>
        {{ $v }}
    </option>
    @elseif (is_array($value))
    <option value="{{ $k }}" @selected(in_array($k, $value))>
        {{ $v }}
    </option>
    @else
    <option value="{{ $k }}" @selected($value->contains($k))>
        {{ $v }}
    </option>
    @endif

    @endforeach
</select>
