<x-bootstrap::form.control-group>
    <x-bootstrap::form.control-group.span>{{ $spanContent }}</x-bootstrap::form.control-group.span>
    <x-bootstrap::form.control-group.control type="text" name="{{ $inputName }}"/>
    <x-bootstrap::form.control-group.button type="button" id="group-btn-id">{{ $buttonContent }}</x-bootstrap::form.control-group.button>
</x-bootstrap::form.control-group>