<div class="{{ $wrapperClass() }}">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="form-label">{{ $label }}</label>
    @endif
    <select {{ $attributes->except('value') }}>
        @foreach($options as $option)
            <option {{ $option->attributes }}{{ $isSelected($option->attributes->get('value')) ? ' selected' : '' }}>{{ $option }}</option>
        @endforeach
    </select>
</div>
