{{--
Card with content in the body and footer
 @package x-bootstrap::component.card
 @var string $content
 @var string $footer
--}}
<x-bootstrap::component.card footer="{{ $footer }}">
    {{ $content }}
</x-bootstrap::component.card>
