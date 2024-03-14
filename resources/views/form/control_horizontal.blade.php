<div class="mb-3 row">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="col-sm-2 col-form-label">{{ $label }}</label>
    @endif
    <div class="col-sm-10">
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
