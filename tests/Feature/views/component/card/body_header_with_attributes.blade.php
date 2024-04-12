{{--
Card with content in the body and header with header attributes
 @package x-bootstrap::component.card
 @var string $content
 @var string $header
 @var string $headerClass
--}}
<x-bootstrap::component.card>
    {{ $content }}
    <x-slot:header id="the-header" class="{{ $headerClass }}">{{ $header }}</x-slot:header>
</x-bootstrap::component.card>
