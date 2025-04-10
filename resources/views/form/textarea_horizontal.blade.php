<div class="mb-3 row">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="{{ $horizontalLabelWidth() }} col-form-label">{{ $label }}</label>
    @endif
    <div class="{{ $horizontalWidth() }}">
        <textarea {{ $attributes }}>{{ $slot }}</textarea>
    </div>
    @if (isset($help))
        <div class="col-auto">
            <div id="{{ $attributes['id'] . '-help' }}" class="form-text">{{ $help }}</div>
        </div>
    @endif
</div>
