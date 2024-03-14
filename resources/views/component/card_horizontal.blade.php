<div {{ $attributes }}>
    <div class="row g-0">
        @if($header->isNotEmpty() || $headerImage->isNotEmpty() || $headerImage->attributes->empty())
            <div class="col-md-4">
                @if($header->isNotEmpty())
                    <div class="card-header">{{ $header }}</div>
                @elseif($headerImage->isNotEmpty() || $headerImage->attributes->empty())
                    <img src="{{ $headerImage }}" class="img-fluid rounded-start" alt="{{ $headerImage ?? 'Image Top' }}">
                @endif
            </div>
        @endif

        <div class="col-md-8">
            <div class="card-body">
                @if($title->isNotEmpty())<h5 {{ $title->attributes->class(['card-title']) }}>{{ $title }}</h5>@endif
                @if($subtitle->isNotEmpty())<h6 {{ $subtitle->attributes->class(['card-subtitle mb-2 text-muted']) }}>{{ $subtitle }}</h6>@endif
                @if($text->isNotEmpty())<p {{ $text->attributes->class(['card-text']) }}>{{ $text }}</p>@endif
                @if($slot->isNotEmpty())
                    {{ $slot }}
                @endif
            </div>
        </div>
    </div>
</div>
