{{--
OL type list group
 @package x-bootstrap::component.list-group
 @var array $items
--}}
<x-bootstrap::component.list-group type="a">
    @foreach($items as $item)
        <x-slot:items :href="$item['href']" :id="$item['id']">{{ $item['html'] }}</x-slot:items>
    @endforeach
</x-bootstrap::component.list-group>
