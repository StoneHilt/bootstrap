<div class="mb-3">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="form-label">{{ $label }}</label>
    @endif
    <select {{ $attributes }}>
        @foreach($options as $option => $text)
            <option value="{{ $option }}" {{ $isSelected($option) ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach
    </select>
</div>
