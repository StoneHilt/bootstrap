{{--
Form select with typical parameters
 @package x-bootstrap::form.select
 @var string $name
 @var array $options
 @var string $label
 @var string $value
 @var string $id
--}}
<x-bootstrap::form.select :name="$name" :id="$id" :value="$value" :label="$label">
    @foreach($options as $value => $text)
        <x-slot:options :value="$value" id="id-of-{{ $value }}">{{ $text }}</x-slot:options>
    @endforeach
</x-bootstrap::form.select>
