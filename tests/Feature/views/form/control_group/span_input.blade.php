{{--
2-Component Input Group with a text block followed by a control
 @package x-bootstrap::form.control-group
 @subpackage x-bootstrap::form.control-group.control
 @subpackage x-bootstrap::form.control-group.span
 @var string $inputName Input Name
 @var string $spanContent Span's content
--}}
<x-bootstrap::form.control-group>
    <x-bootstrap::form.control-group.span>{{ $spanContent }}</x-bootstrap::form.control-group.span>
    <x-bootstrap::form.control-group.control type="text" name="{{ $inputName }}"/>
</x-bootstrap::form.control-group>
