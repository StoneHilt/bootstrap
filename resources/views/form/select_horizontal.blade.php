<div class="mb-3 row">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="{{ $horizontalLabelWidth() }} col-form-label">{{ $label }}</label>
    @endif
    <div class="{{ $horizontalWidth() }}">
        <select {{ $attributes->except('value') }}>
            @foreach($options as $option => $text)
                <option value="{{ $option }}" {{ $isSelected($option) ? 'selected' : '' }}>{{ $text }}</option>
            @endforeach
        </select>
    </div>
</div>
