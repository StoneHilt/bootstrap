{{--
2-Component Input Group with a control followed by a button
 @package x-bootstrap::form.control-group
 @subpackage x-bootstrap::form.control-group.control
 @subpackage x-bootstrap::form.control-group.button
 @var string $inputName Input Name
 @var string $buttonContent Button's content
--}}
<x-bootstrap::form.control-group>
    <x-bootstrap::form.control-group.control type="text" name="{{ $inputName }}"/>
    <x-bootstrap::form.control-group.button type="button">{{ $buttonContent }}</x-bootstrap::form.control-group.button>
</x-bootstrap::form.control-group>