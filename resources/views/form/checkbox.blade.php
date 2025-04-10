<div class="{{ $wrapperClass() }}">
    <input {{ $attributes }}>
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="{{ $labelClass() }}">{{ $label }}</label>
    @endif
    @if (isset($help))
        <div id="{{ $attributes['id'] . '-help' }}" class="form-text">{{ $help }}</div>
    @endif
</div>
