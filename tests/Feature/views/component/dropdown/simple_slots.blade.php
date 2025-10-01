{{--
Simple dropdown - with slots
 @package x-bootstrap::component.dropdown
 @var array $items
--}}
<x-bootstrap::component.dropdown :label="$label">
    @foreach($items as $item)
        <x-bootstrap::component.dropdown.item>{{ $item }}</x-bootstrap::component.dropdown.item>
    @endforeach
</x-bootstrap::component.dropdown>
