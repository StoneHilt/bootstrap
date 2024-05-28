<{{ $wrapperElement() }} {{ $attributes }}>
    @foreach($items as $item)
        @if (in_array($type, ['checkbox', 'radio']))
            <li class="list-group-item">
                <input type="{{ $type }}" {{ $item->attributes->class([$item->attributes->prepends('form-check-input me-1')]) }}>
                <label class="form-check-label" for="{{ $item->attributes['id'] }}">{{ $item }}</label>
            </li>
        @else
            <{{ $itemElement() }} {{ $item->attributes->class([$item->attributes->prepends('list-group-item')]) }}>{{ $item }}</{{ $itemElement() }}>
        @endif
    @endforeach
</{{ $wrapperElement() }}>
