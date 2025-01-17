<div {{ $attributes }}>
    <div class="row g-0">
        @if($header->isNotEmpty() || $headerImage->isNotEmpty() || $headerImage->attributes->empty())
            <div class="col-md-4">
                @if($header->isNotEmpty())
                    <div {{ $header->attributes->class([$header->attributes->prepends('card-header')]) }}>{{ $header }}</div>
                @elseif($headerImage->isNotEmpty() || $headerImage->attributes->empty())
                    <img src="{{ $headerImage }}" class="img-fluid rounded-start" alt="{{ $headerImage ?? 'Image Top' }}">
                @endif
            </div>
        @endif

        <div class="col-md-8">
            <div class="card-body">
                @if($title->isNotEmpty())<{{ $title->attributes->get('tag', 'h5') }} {{ $title->attributes->class(['card-title'])->except(['tag']) }}>{{ $title }}</{{ $title->attributes->get('tag', 'h5') }}>@endif
                @if($subtitle->isNotEmpty())<{{ $subtitle->attributes->get('tag', 'h6') }} {{ $subtitle->attributes->class(['card-subtitle mb-2 text-muted'])->except(['tag']) }}>{{ $subtitle }}</{{ $subtitle->attributes->get('tag', 'h6') }}>@endif
                @if($text->isNotEmpty())<{{ $text->attributes->get('tag', 'p') }} {{ $text->attributes->class(['card-text'])->except(['tag']) }}>{{ $text }}</{{ $text->attributes->get('tag', 'p') }}>@endif
                @if($slot->isNotEmpty())
                    {{ $slot }}
                @endif
            </div>
        </div>
    </div>
</div>
