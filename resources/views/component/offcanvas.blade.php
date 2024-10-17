<div {{ $attributes }} tabindex="-1" id="{{ $id }}">
    @isset($title)
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="{{ $titleId }}">{{ $title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="{{ $id }}" aria-label="Close"></button>
        </div>
    @endisset
    <div class="offcanvas-body">
        {{ $slot }}
    </div>
</div>

