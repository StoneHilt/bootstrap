{{--
Simple Offcanvas with title
 @package x-bootstrap::component.offcanvas
 @var string $id
 @var string $title
 @var string $content
--}}
<x-bootstrap::component.offcanvas
        :id="$id"
        :title="$title"
        :title-id="$titleId"
        :scroll="$scroll"
        :backdrop="$backdrop"
        :backdrop-static="$backdropStatic"
        :placement="$placement"
        :show="$show"
>
    {{ $content }}
</x-bootstrap::component.offcanvas>
