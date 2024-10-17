{{--
2-Component Input Group with a label in a horizontal layout
 @package x-bootstrap::form.control-group
 @subpackage x-bootstrap::form.control-group.control
 @subpackage x-bootstrap::form.control-group.button
 @var string $label Label
 @var string $id Id
 @var string $inputName Input Name
 @var string $buttonContent Button's content
--}}
<x-bootstrap::form.control-group :horizontal="true" :label="$label" :id="$id">
    <x-bootstrap::form.control-group.control type="text" name="{{ $inputName }}" :id="$id"/>
    <x-bootstrap::form.control-group.button type="button">{{ $buttonContent }}</x-bootstrap::form.control-group.button>
</x-bootstrap::form.control-group>