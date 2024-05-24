{{--
Form checkbox with all available parameters
 @package x-bootstrap::form.checkbox
 @var string $name
 @var string $label
 @var string $id
 @var string $value
 @var bool $checked
 @var ?string $size
 @var bool $disabled
 @var bool $horizontal
 @var bool $reverse
--}}
<x-bootstrap::form.checkbox
    :name="$name"
    :id="$id"
    :value="$value"
    :checked="$checked"
    :label="$label"
    :size="$size"
    :disabled="$disabled"
    :horizontal="$horizontal"
    :reverse="$reverse"
/>
