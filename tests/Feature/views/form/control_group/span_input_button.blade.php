{{--
3-Component Input Group with a text block followed by a control then button
 @package x-bootstrap::form.control-group
 @subpackage x-bootstrap::form.control-group.span
 @subpackage x-bootstrap::form.control-group.control
 @subpackage x-bootstrap::form.control-group.button
 @var string $spanContent Span's content
 @var string $inputName Input Name
 @var string buttonContent Button's content
--}}
<x-bootstrap::form.control-group>
    <x-bootstrap::form.control-group.span>{{ $spanContent }}</x-bootstrap::form.control-group.span>
    <x-bootstrap::form.control-group.control type="text" name="{{ $inputName }}"/>
    <x-bootstrap::form.control-group.button type="button" id="group-btn-id">{{ $buttonContent }}</x-bootstrap::form.control-group.button>
</x-bootstrap::form.control-group>