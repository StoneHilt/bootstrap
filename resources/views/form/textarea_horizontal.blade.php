<div class="mb-3 row">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="col-sm-2 col-form-label">{{ $label }}</label>
    @endif
    <div class="col-sm-10">
        <textarea {{ $attributes }}>{{ $slot }}</textarea>
    </div>
</div>
