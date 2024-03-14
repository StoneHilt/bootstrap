<{{ $type }} {{ $attributes }}>
    {{ $slot }}
    @isset($secondary)
    <small class="text-body-secondary">{{ $secondary }}</small>
    @endisset
</{{ $type }}>
