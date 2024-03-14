<div class="{{ $wrapperClass() }}">
    @if($attributes->has('href'))
        <a {{ $attributes }}>{{ $label }}</a>
    @else
        <button {{ $attributes }}>{{ $label }}</button>
    @endif
    <ul class="dropdown-menu">
        @foreach($items as $item)
            {{ $item }}
        @endforeach
    </ul>
</div>
