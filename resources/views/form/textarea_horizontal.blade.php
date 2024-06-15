<div class="mb-3 row">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="{{ $horizontalLabelWidth() }} col-form-label">{{ $label }}</label>
    @endif
    <div class="{{ $horizontalWidth() }}">
        <textarea {{ $attributes }}>{{ $slot }}</textarea>
    </div>
</div>
