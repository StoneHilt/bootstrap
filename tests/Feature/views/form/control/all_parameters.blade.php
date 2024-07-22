{{--
Form control with all available parameters
 @package x-bootstrap::form.control
 @var string $type
 @var string $name
 @var string $label
 @var string $id
 @var string $value
 @var ?string $size
 @var bool $disabled
 @var bool $readonly
 @var bool $plaintext
 @var bool $horizontal
 @var array|string $horizontalWidth
 @var ?array $datalist
 @var array|string $wrapperClass
--}}
<x-bootstrap::form.control
        :type="$type"
        :name="$name"
        :id="$id"
        :value="$value"
        :label="$label"
        :size="$size"
        :disabled="$disabled"
        :readonly="$readonly"
        :plaintext="$plaintext"
        :horizontal="$horizontal"
        :horizontalWidth="$horizontalWidth"
        :datalist="$datalist"
        :wrapperClass="$wrapperClass"
 />
