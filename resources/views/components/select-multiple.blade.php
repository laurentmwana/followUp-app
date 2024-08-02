@props(['disabled' => false, 'items' => [], 'value' =>  null, 'placeholder' => ''])

<select   {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '"flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50",
']) !!} multiple tom-select-target>

<option value="">
    {{ $placeholder }}
</option>

@foreach ($items as $k => $v)

    <option value="{{ $k }}" @selected(is_array($value) ? in_array($k, $value) : $value->contains($k))>
        {{ $v }}
    </option>
@endforeach
</select>
