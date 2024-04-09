{{--
2-Component Input Group with a text block followed by a textarea
 @package x-bootstrap::form.control-group
 @subpackage x-bootstrap::form.control-group.span
 @subpackage x-bootstrap::form.control-group.textarea
 @var string $spanContent Span's content
 @var string $textareaName Textarea's Name
 @var string $textareaContent Textarea's Content
--}}
<x-bootstrap::form.control-group>
    <x-bootstrap::form.control-group.span>{{ $spanContent }}</x-bootstrap::form.control-group.span>
    <x-bootstrap::form.control-group.textarea name="{{ $textareaName }}">{{ $textareaContent }}</x-bootstrap::form.control-group.textarea>
</x-bootstrap::form.control-group>