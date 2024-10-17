<div class="{{ $wrapperClass() }}">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="{{ $horizontalLabelWidth() }} col-form-label">{{ $label }}</label>
    @endif
    <div class="{{ $horizontalWidth() }} input-group">
        {{ $slot }}
    </div>
    @if (isset($help))
        <div class="form-text">{{ $help }}</div>
    @endif
</div>
