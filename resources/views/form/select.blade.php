<div class="{{ $wrapperClass() }}">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="form-label">{{ $label }}</label>
    @endif
    <select {{ $attributes->except('value') }}>
        @foreach($options as $option => $text)
            <option value="{{ $option }}" {{ $isSelected($option) ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach
    </select>
</div>
