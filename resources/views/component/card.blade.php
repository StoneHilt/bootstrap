<div {{ $attributes }}>
    @if($header->isNotEmpty())
        <div class="card-header">{{ $header }}</div>
    @elseif($headerImage->isNotEmpty())
        <img src="{{ $headerImage }}" class="card-img-top" alt="{{ $headerImage ?? 'Image Top' }}">
    @endif
    <div class="card-body">
        @if($title->isNotEmpty())<h5 {{ $title->attributes->class(['card-title']) }}>{{ $title }}</h5>@endif
        @if($subtitle->isNotEmpty())<h6 {{ $subtitle->attributes->class(['card-subtitle mb-2 text-muted']) }}>{{ $subtitle }}</h6>@endif
        @if($text->isNotEmpty())<p {{ $text->attributes->class(['card-text']) }}>{{ $text }}</p>@endif
        @if($slot->isNotEmpty())
            {{ $slot }}
        @endif
    </div>

    @if($footer->isNotEmpty())
        <div class="card-footer">{{ $footer }}</div>
    @elseif($footerImage->isNotEmpty())
        <img src="{{ $footerImage }}" class="card-img-bottom" alt="{{ $footerImage ?? 'Image Bottom' }}">
    @endif
</div>
