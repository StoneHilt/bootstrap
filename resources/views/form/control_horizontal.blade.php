<div class="mb-3 row">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="{{ $horizontalLabelWidth() }} col-form-label">{{ $label }}</label>
    @endif
    <div class="{{ $horizontalWidth() }}">
        <input {{ $attributes }} @if (isset($datalist)) list="{{ $attributes['id'] }}-datalist" @endif>
    </div>
    @if (isset($datalist))
        <datalist id="{{ $attributes['id'] }}-datalist">
            @foreach($datalist as $option)
                <option value="{{ $option }}">
            @endforeach
        </datalist>
    @endif
</div>
