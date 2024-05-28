{{--
Simple list group using slots for items
 @package x-bootstrap::component.list-group
 @var array $items
--}}
<x-bootstrap::component.list-group>
    @foreach($items as $item)
        <x-slot:items>{{ $item }}</x-slot:items>
    @endforeach
</x-bootstrap::component.list-group>
