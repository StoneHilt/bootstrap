{{--
Card with the sections having non-default tags
 @package x-bootstrap::component.card
 @var bool $horizontal
 @var string $header
 @var string $headerClass
 @var string $title
 @var string $titleTag
 @var string $titleClass
 @var string $subtitle
 @var string $subtitleTag
 @var string $subtitleClass
 @var string $text
 @var string $textTag
 @var string $textClass
--}}
<x-bootstrap::component.card id="the-card" :horizontal="$horizontal">
    <x-slot:header id="the-header" class="{{ $headerClass }}">{{ $header }}</x-slot:header>
    <x-slot:title id="the-title" :tag="$titleTag" class="{{ $titleClass }}">{{ $title }}</x-slot:title>
    <x-slot:subtitle id="the-subtitle" :tag="$subtitleTag"  class="{{ $subtitleClass }}">{{ $subtitle }}</x-slot:subtitle>
    <x-slot:text id="the-text" :tag="$textTag"  class="{{ $textClass }}">{{ $text }}</x-slot:text>
</x-bootstrap::component.card>
