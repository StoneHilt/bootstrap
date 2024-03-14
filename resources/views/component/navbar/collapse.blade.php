<div class="collapse navbar-collapse" id="{{ $id }}">
    @if(!empty($links))
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @foreach($links as $link)
                @if($link->attributes->has('href'))
                    <li class="nav-item">
                        <a {{ $link->attributes->class(['nav-link'])->merge(['aria-current' => 'page']) }}>{{ $link }}</a>
                    </li>
                @else
                    <li {{ $link->attributes->class(['nav-item']) }}>
                        {{ $link }}
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
    {{ $slot }}
</div>
