{{--
Card with content in the body and header with header attributes
 @package x-bootstrap::component.card
 @var string $content
 @var bool $horizontal
 @var string $headerImage
 @var string $headerClass
--}}
<x-bootstrap::component.card :horizontal="$horizontal">
    {{ $content }}
    <x-slot:header-image id="the-header" class="{{ $headerClass }}">{{ $headerImage }}</x-slot:header-image>
</x-bootstrap::component.card>
