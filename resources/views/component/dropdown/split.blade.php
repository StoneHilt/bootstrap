<div class="{{ $wrapperClass() }}">
    @if($attributes->has('href'))
        <a {{ $attributes }}>{{ $label }}</a>
    @else
        <button {{ $attributes }}>{{ $label }}</button>
    @endif
    <button type="button" class="btn btn-{{ $variant }} dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>

    <ul class="dropdown-menu">
        @foreach($items as $item)
            {{ $item }}
        @endforeach
    </ul>
</div>
