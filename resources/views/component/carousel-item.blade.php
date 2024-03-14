<div @class(['carousel-item', 'active' => !$itemIndex]) @isset($interval) data-bs-interval="{{ $interval }}" @endisset>
    <img src="{{ $src }}" class="d-block w-100" alt="{{ $alt }}">
    @if ($slot->hasActualContent())
        <div class="carousel-caption d-none d-md-block">
            {{ $slot }}
        </div>
    @endif
</div>
