@foreach($options as $value => $label)
    <div class="{{ $wrapperClass() }}">
        <input {{ $attributes->except(['id', 'value']) }} id="{{ $attributes['id'] . '-' . $loop->index }}" value="{{ $value }}" {{ $isChecked($value) ? 'checked' : '' }}>
        @if (!empty($label))
            <label for="{{ $attributes['id'] . '-' . $loop->index }}" class="{{ $labelClass($value) }}">{{ $label }}</label>
        @endif
    </div>
@endforeach
