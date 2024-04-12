{{--
General heading with secondary heading floated to the end of the heading
 @package x-bootstrap::typography.heading
 @var string $type
 @var string $content
 @var string $secondary
--}}
<x-bootstrap::typography.heading type="{{ $type }}">
    {{ $content }}
    <x-slot:secondary class="float-end" id="secondary-heading">{{ $secondary }}</x-slot:secondary>
</x-bootstrap::typography.heading>
