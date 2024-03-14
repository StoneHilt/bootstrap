<div class="accordion" id="{{ $id }}">
    @forelse ($items as $itemId => $content)
        <div class="accordion-item">
            <h2 class="accordion-header" id="{{ $itemId }}-heading">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $itemId }}-body" aria-expanded="true" aria-controls="{{ $itemId }}-body">
                    {{ $content['header'] ?? $content[0] }}
                </button>
            </h2>
            <div id="{{ $itemId }}-body" class="accordion-collapse collapse show" aria-labelledby="{{ $itemId }}-heading" data-bs-parent="#{{ $id }}">
                <div class="accordion-body">
                    {{ $content['header'] ?? $content[1] }}
                </div>
            </div>
        </div>
    @empty
        {{ $slot }}
    @endforelse
</div>
