<?php

namespace StoneHilt\Bootstrap\Components\Form;

use Illuminate\View\ComponentAttributeBag;

/**
 * Class Select
 *
 * @package StoneHilt\Bootstrap\Components\Form
 *
 */
class Select extends AbstractFormComponent
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::form.select';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options,
        public ?string $label = null,
        public ?string $size = null,
        public bool $disabled = false,
        public bool $multiple = false,
        public bool $horizontal = false,
        public string|array $horizontalWidth = 'sm-10',
        public string|array $wrapperClass = 'mb-3',
    ) {
        parent::__construct(
            name: $this->name,
            label: $this->label,
            size: $this->size,
            horizontal: $this->horizontal,
            horizontalWidth: $this->horizontalWidth,
            wrapperClass: $this->wrapperClass
        );
    }

    /**
     * @param string $value
     * @return bool
     */
    public function isSelected(string $value): bool
    {
        return ($this->attributes->get('value', null) === $value);
    }

    /**
     * @return string
     */
    public function wrapperClass(): string
    {
        $classes = [];

        if ($this->horizontal) {
            $classes[] = 'row';
        }

        if (!empty($this->wrapperClass)) {
            $classes = array_merge($classes, (array)$this->wrapperClass);
        }

        return implode(' ', $classes);
    }

    /**
     * @return string
     */
    protected function getView(): string
    {
        return $this->horizontal ? $this->viewName .= '_horizontal' : $this->viewName;
    }

    /**
     * Override to transform/add attributes at render time
     *
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        $attributes = $attributes->class(
            [
                'form-control',
                'form-control-' . $this->size => isset($this->size) && $this->size !== 'md',
            ]
        );

        if ($this->disabled) {
            $attributes['disabled'] = true;
        }

        if ($this->multiple) {
            $attributes['multiple'] = true;
        }

        return parent::transformAttributes($attributes);
    }
}
