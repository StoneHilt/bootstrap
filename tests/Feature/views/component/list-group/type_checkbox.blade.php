{{--
List group of checkboxes
 @package x-bootstrap::component.list-group
 @var array $items
--}}
<x-bootstrap::component.list-group type="checkbox">
    @foreach($items as $id => $item)
        <x-slot:items :id="$id">{{ $item }}</x-slot:items>
    @endforeach
</x-bootstrap::component.list-group>
