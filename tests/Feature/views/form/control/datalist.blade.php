{{--
General form control with a data list
 @package x-bootstrap::form.control
 @var string $label
 @var string $name
 @var array $datalist
--}}
<x-bootstrap::form.control label="{{ $label }}" name="{{ $name }}" type="text" id="{{ $id }}" :$datalist />