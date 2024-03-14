@inherit(['type' => 'navType'])

@if(in_array($navType ?? null, ['ul', 'ol']))
<li class="nav-item">
@endif
@if (!empty($href))
    <a href="{{ $href }}" {{ $attributes->class([$attributes->prepends('nav-link')]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->class([$attributes->prepends('nav-link')]) }} type="button">
        {{ $slot }}
    </button>
@endif
@if(in_array($navType ?? null, ['ul', 'ol']))
</li>
@endif
