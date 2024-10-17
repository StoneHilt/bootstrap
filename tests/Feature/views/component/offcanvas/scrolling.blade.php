{{--
Simple Offcanvas with title
 @package x-bootstrap::component.offcanvas
 @var string $id
 @var string $title
 @var string $content
--}}
<x-bootstrap::component.offcanvas :id="$id" :title="$title" :scroll="true">
    {{ $content }}
</x-bootstrap::component.offcanvas>