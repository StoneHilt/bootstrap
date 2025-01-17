<div {{ $attributes }}>
    @if($header->isNotEmpty())
        <div {{ $header->attributes->class([$header->attributes->prepends('card-header')]) }}>{{ $header }}</div>
    @elseif($headerImage->isNotEmpty())
        <img src="{{ $headerImage }}" class="card-img-top" alt="{{ $headerImage ?? 'Image Top' }}">
    @endif
    <div class="card-body">
        @if($title->isNotEmpty())<{{ $title->attributes->get('tag', 'h5') }} {{ $title->attributes->class(['card-title'])->except(['tag']) }}>{{ $title }}</{{ $title->attributes->get('tag', 'h5') }}>@endif
        @if($subtitle->isNotEmpty())<{{ $subtitle->attributes->get('tag', 'h6') }} {{ $subtitle->attributes->class(['card-subtitle mb-2 text-muted'])->except(['tag']) }}>{{ $subtitle }}</{{ $subtitle->attributes->get('tag', 'h6') }}>@endif
        @if($text->isNotEmpty())<{{ $text->attributes->get('tag', 'p') }} {{ $text->attributes->class(['card-text'])->except(['tag']) }}>{{ $text }}</{{ $text->attributes->get('tag', 'p') }}>@endif
        @if($slot->isNotEmpty())
            {{ $slot }}
        @endif
    </div>

    @if($footer->isNotEmpty())
        <div {{ $footer->attributes->class([$footer->attributes->prepends('card-footer')]) }}>{{ $footer }}</div>
    @elseif($footerImage->isNotEmpty())
        <img src="{{ $footerImage }}" class="card-img-bottom" alt="{{ $footerImage ?? 'Image Bottom' }}">
    @endif
</div>
