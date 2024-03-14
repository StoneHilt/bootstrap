<div class="mb-3">
    @if (isset($label))
    <label for="{{ $attributes['id'] }}" class="form-label">{{ $label }}</label>
    @endif
    <input {{ $attributes }} @if (isset($datalist)) list="{{ $attributes['id'] }}-datalist" @endif>
    @if (isset($datalist))
        <datalist id="{{ $attributes['id'] }}-datalist">
            @foreach($datalist as $option)
                <option value="{{ $option }}">
            @endforeach
        </datalist>
    @endif
</div>
