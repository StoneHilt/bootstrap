<?php

namespace StoneHilt\Bootstrap\Components\Form;

use Illuminate\View\ComponentAttributeBag;

/**
 * Class Control
 *
 * @package StoneHilt\Bootstrap\Components\Form
 *
 */
class Control extends AbstractFormComponent
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::form.control';

    /**
     * @param string $type
     * @param string $name
     * @param string|null $label
     * @param string|null $size
     * @param bool $disabled
     * @param bool $readonly
     * @param bool $plaintext
     * @param bool $horizontal
     * @param string|null $help
     * @param string|array $horizontalWidth Apply specific width to the input when in horizontal mode
     * @param array|null $datalist
     * @param string|array $wrapperClass
     */
    public function __construct(
        public string $type,
        public string $name,
        public ?string $label = null,
        public ?string $size = null,
        public bool $disabled = false,
        public bool $readonly = false,
        public bool $plaintext = false,
        public bool $horizontal = false,
        public ?string $help = null,
        public string|array $horizontalWidth = 'sm-10',
        public ?array $datalist = null,
        public string|array $wrapperClass = 'mb-3',
    ) {
        parent::__construct(
            name: $this->name,
            label: $this->label,
            size: $this->size,
            horizontal: $this->horizontal,
            help: $this->help,
            horizontalWidth: $this->horizontalWidth,
            wrapperClass: $this->wrapperClass
        );
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
        $viewName = match($this->type) {
            'textarea' => 'bootstrap::form.textarea',
            default    => $this->viewName
        };

        return $this->horizontal ? $viewName . '_horizontal' : $viewName;
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
                $this->plaintext ? 'form-control-plaintext' : 'form-control',
                'form-control-color' => $this->type === 'color',
                'form-control-' . $this->size => isset($this->size) && $this->size !== 'md',
            ]
        );

        if ($this->type === 'textarea' && !$attributes->has('rows')) {
            $attributes['rows'] = 3;
        } else {
            $attributes['type'] = $this->type;
        }

        if ($this->disabled) {
            $attributes['disabled'] = true;
        }

        if ($this->readonly) {
            $attributes['readonly'] = true;
        }

        return parent::transformAttributes($attributes);
    }
}
