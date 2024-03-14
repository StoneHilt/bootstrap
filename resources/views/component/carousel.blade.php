<div id="{{ $id }}"
     @class(['carousel', 'slide', 'carousel-fade' => $fade])
     @isset($autoplayStart) data-bs-ride="{{ $autoplayStart ? 'carousel' : 'true'}}" @endisset
     @if (!$touch) data-bs-touch="false" @endif
>
    @if ($indicators)
    <div class="carousel-indicators">
        @for($i = 0; $i < $itemCount; $i++)
            <button
                type="button"
                data-bs-target="#{{ $id }}"
                data-bs-slide-to="{{ $i }}"
                @class(['active' => !$i])
                {{ $i == 0 ? 'aria-current="true"' : '' }}
                aria-label="{{ array_values($items)[$i] ?? 'Slide ' . $i }}"></button>
        @endfor
    </div>
    @endif
    <div class="carousel-inner">
        @forelse ($items as $src => $alt)
            <div @class(['carousel-item', 'active' => $loop->first])>
                <img src="{{ $src }}" class="d-block w-100" alt="{{ $alt }}">
            </div>
        @empty
            {{ $slot }}
        @endforelse
    </div>
    @if ($includeControls)
        <button class="carousel-control-prev" type="button" data-bs-target="#{{ $id }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#{{ $id }}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif
</div>
