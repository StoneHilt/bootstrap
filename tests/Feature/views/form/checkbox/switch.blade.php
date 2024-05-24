{{--
Form swith style checkbox with typical parameters
 @package x-bootstrap::form.checkbox
 @var string $name
 @var string $label
 @var string $value
 @var string $id
 @var bool $checked
--}}
<x-bootstrap::form.checkbox type="switch" :name="$name" :id="$id" :value="$value" :checked="$checked" :label="$label" />
