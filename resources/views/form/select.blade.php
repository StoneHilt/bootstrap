<div class="{{ $wrapperClass() }}">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="form-label">{{ $label }}</label>
    @endif
    <select {{ $attributes->except('value') }}>
        @foreach($options as $option)
            <option {{ $option->attributes }}{{ $isSelected($option->attributes->get('value')) ? ' selected' : '' }}>{{ $option }}</option>
        @endforeach
    </select>
    @if (isset($help))
        <div id="{{ $attributes['id'] . '-help' }}" class="form-text">{{ $help }}</div>
    @endif
</div>
