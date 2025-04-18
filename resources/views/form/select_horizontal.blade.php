<div class="{{ $wrapperClass() }}">
    @if (isset($label))
        <label for="{{ $attributes['id'] }}" class="{{ $horizontalLabelWidth() }} col-form-label">{{ $label }}</label>
    @endif
    <div class="{{ $horizontalWidth() }}">
        <select {{ $attributes->except('value') }}>
            @foreach($options as $option)
                <option {{ $option->attributes }}{{ $isSelected($option->attributes->get('value')) ? ' selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>
    </div>
    @if (isset($help))
        <div class="col-auto">
            <div id="{{ $attributes['id'] . '-help' }}" class="form-text">{{ $help }}</div>
        </div>
    @endif
</div>
