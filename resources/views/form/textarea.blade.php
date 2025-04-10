<div class="mb-3">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="form-label">{{ $label }}</label>
    @endif
    <textarea {{ $attributes }}>{{ $slot }}</textarea>
    @if (isset($help))
        <div id="{{ $attributes['id'] . '-help' }}" class="form-text">{{ $help }}</div>
    @endif
</div>
