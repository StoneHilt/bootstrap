@inherit(['type' => 'navType'])
@php($tag = in_array($navType ?? null, ['ul', 'ol']) ? 'li' : 'div')

<{{ $tag }} {{ $attributes->class([$attributes->prepends('nav-item dropdown')]) }}>
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ $label }}</a>
    <ul class="dropdown-menu">
        @foreach($items as $item)
            {{ $item }}
        @endforeach
    </ul>
</{{ $tag }}>
