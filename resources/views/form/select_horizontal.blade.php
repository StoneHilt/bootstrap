<div class="mb-3 row">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="col-sm-2 col-form-label">{{ $label }}</label>
    @endif
    <div class="col-sm-10">
        <select {{ $attributes }}>
            @foreach($options as $option => $text)
                <option value="{{ $option }}" {{ $isSelected($option) ? 'selected' : '' }}>{{ $text }}</option>
            @endforeach
        </select>
    </div>
</div>
