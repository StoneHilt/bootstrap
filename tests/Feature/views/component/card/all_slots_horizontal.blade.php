{{--
Card with all of the slots set
 @package x-bootstrap::component.card
 @var string $content
 @var string $header
 @var string $headerClass
 @var string $title
 @var string $titleClass
 @var string $subtitle
 @var string $subtitleClass
 @var string $text
 @var string $textClass
--}}
<x-bootstrap::component.card id="the-card" :horizontal="true">
    {{ $content }}
    <x-slot:header id="the-header" class="{{ $headerClass }}">{{ $header }}</x-slot:header>
    <x-slot:title id="the-title" class="{{ $titleClass }}">{{ $title }}</x-slot:title>
    <x-slot:subtitle id="the-subtitle" class="{{ $subtitleClass }}">{{ $subtitle }}</x-slot:subtitle>
    <x-slot:text id="the-text" class="{{ $textClass }}">{{ $text }}</x-slot:text>
</x-bootstrap::component.card>
