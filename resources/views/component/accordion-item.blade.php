@inherit(['id' => 'accordionId'])

<div class="accordion-item" id="{{ $attributes['id'] ?? $id }}">
    <h2 class="accordion-header" id="{{ $attributes['id'] ?? $id }}-heading">
        <button class="accordion-button {{ $open ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $attributes['id'] ?? $id }}-body" aria-expanded="{{ $open ? 'true' : 'false' }}" aria-controls="{{ $attributes['id'] ?? $id }}-body">
            {{ $header }}
        </button>
    </h2>
    <div id="{{ $attributes['id'] ?? $id }}-body" class="accordion-collapse collapse {{ $open ? 'true' : '' }}" aria-labelledby="{{ $attributes['id'] ?? $id }}-heading" @if (!$alwaysOpen) data-bs-parent="#{{ $accordionId }}" @endif>
        <div class="accordion-body">
            {{ $slot }}
        </div>
    </div>
</div>
