<nav aria-label="breadcrumb" {{ $attributes }}>
    <ol class="breadcrumb">
        @foreach($items as $href => $text)
            @if($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $text }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ $href }}">{{ $text }}</a></li>
            @endif
        @endforeach
    </ol>
</nav>
