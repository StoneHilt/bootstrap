{{--
Card with content in the body and footer with footer attributes
 @package x-bootstrap::component.card
 @var string $content
 @var string $footerImage
 @var string $footerClass
--}}
<x-bootstrap::component.card>
    {{ $content }}
    <x-slot:footer-image id="the-footer" class="{{ $footerClass }}">{{ $footerImage }}</x-slot:footer-image>
</x-bootstrap::component.card>
