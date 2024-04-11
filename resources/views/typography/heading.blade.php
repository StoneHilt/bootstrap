<{{ $type }} {{ $attributes }}>
    {{ $slot }}
    @if($secondary->isNotEmpty())
    <small {{ $secondary->attributes->class([$secondary->attributes->prepends('text-body-secondary')]) }}>{{ $secondary }}</small>
    @endisset
</{{ $type }}>
