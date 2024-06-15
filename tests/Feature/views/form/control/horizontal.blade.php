{{--
General form control without a label
 @package x-bootstrap::form.control
 @var string $name
 @var string $label
 @var string $id
 @var string|array $horizontalWidth
--}}
<x-bootstrap::form.control name="{{ $name }}" :label="$label" :id="$id" type="text" horizontal="true" :horizontal-width="$horizontalWidth" />
