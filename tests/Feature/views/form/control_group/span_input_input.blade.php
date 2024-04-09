{{--
3-Component Input Group with a text block followed by a 2 controls
 @package x-bootstrap::form.control-group
 @subpackage x-bootstrap::form.control-group.span
 @subpackage x-bootstrap::form.control-group.control
 @var string $spanContent Span's content
 @var string $inputName First Input's Name
 @var string $altInputName Second Input's Name
--}}
<x-bootstrap::form.control-group>
    <x-bootstrap::form.control-group.span>{{ $spanContent }}</x-bootstrap::form.control-group.span>
    <x-bootstrap::form.control-group.control type="text" name="{{ $inputName }}"/>
    <x-bootstrap::form.control-group.control type="password" name="{{ $altInputName }}"/>
</x-bootstrap::form.control-group>