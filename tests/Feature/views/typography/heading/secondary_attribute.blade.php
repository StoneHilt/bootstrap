{{--
General heading with secondary heading via attribute
 @package x-bootstrap::typography.heading
 @var string $type
 @var string $content
 @var string $secondary
--}}
<x-bootstrap::typography.heading type="{{ $type }}" secondary="{{ $secondary }}">
    {{ $content }}
</x-bootstrap::typography.heading>
