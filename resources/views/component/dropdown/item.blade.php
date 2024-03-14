<li>
@if ($nonInteractive)
    <span {{ $attributes->class([$attributes->prepends('dropdown-item-text')]) }}>{{ $slot }}</span>
@elseif (!empty($href))
    <a href="{{ $href }}" {{ $attributes->class([$attributes->prepends('dropdown-item')]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->class([$attributes->prepends('dropdown-item')]) }} type="button">
        {{ $slot }}
    </button>
@endif
</li>
