<div class="mb-3">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="form-label">{{ $label }}</label>
    @endif
    <div class="input=group">
        {{ $slot }}
    </div>
    @if (isset($help))
        <div class="form-text">{{ $help }}</div>
    @endif
</div>
