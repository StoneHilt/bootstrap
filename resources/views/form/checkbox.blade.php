<div class="{{ $wrapperClass() }}">
    <input {{ $attributes }}>
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="{{ $labelClass() }}">{{ $label }}</label>
    @endif
</div>
