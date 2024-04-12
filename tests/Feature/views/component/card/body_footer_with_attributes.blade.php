{{--
Card with content in the body and footer with footer attributes
 @package x-bootstrap::component.card
 @var string $content
 @var string $footer
 @var string $footerClass
--}}
<x-bootstrap::component.card>
    {{ $content }}
    <x-slot:footer id="the-footer" class="{{ $footerClass }}">{{ $footer }}</x-slot:footer>
</x-bootstrap::component.card>
