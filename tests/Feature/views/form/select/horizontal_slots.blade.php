{{--
Form select with typical parameters in horizontal display
 @package x-bootstrap::form.select
 @var string $name
 @var array $options
 @var string $label
 @var string $value
 @var string $id
--}}
<x-bootstrap::form.select :name="$name" :id="$id" :value="$value" :label="$label" :horizontal="true">
    @foreach($options as $value => $text)
        <x-slot:options :value="$value" id="id-for-{{ $value }}">{{ $text }}</x-slot:options>
    @endforeach
</x-bootstrap::form.select>
