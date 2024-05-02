{{--
General heading with secondary heading via attribute as HtmlString
 @package x-bootstrap::typography.heading
 @var string $type
 @var string $content
 @var string $secondary
--}}
<x-bootstrap::typography.heading type="{{ $type }}">
    {{ $content }}
    <x-slot:secondary id="secondary-heading"><em>{{ new \Illuminate\Support\HtmlString($secondary) }}</em></x-slot:secondary>
</x-bootstrap::typography.heading>
