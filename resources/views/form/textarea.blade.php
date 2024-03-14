<div class="mb-3">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="form-label">{{ $label }}</label>
    @endif
    <textarea {{ $attributes }}>{{ $slot }}</textarea>
</div>
