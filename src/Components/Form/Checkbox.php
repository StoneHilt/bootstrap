<?php

namespace StoneHilt\Bootstrap\Components\Form;

use Illuminate\View\ComponentAttributeBag;

/**
 * Class Checkbox
 *
 * @package StoneHilt\Bootstrap\Components\Form
 *
 */
class Checkbox extends AbstractFormComponent
{
    /**
     * @var array|string[] $variants
     */
    protected static array $types = [
        'checkbox',
        'switch',
        'btn-primary',
        'btn-secondary',
        'btn-success',
        'btn-danger',
        'btn-warning',
        'btn-info',
        'btn-light',
        'btn-dark',
        'btn-outline-primary',
        'btn-outline-secondary',
        'btn-outline-success',
        'btn-outline-danger',
        'btn-outline-warning',
        'btn-outline-info',
        'btn-outline-light',
        'btn-outline-dark',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::form.checkbox';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $type = 'checkbox',
        public ?string $label = null,
        public bool $checked = false,
        public ?string $size = null,
        public bool $disabled = false,
        public bool $horizontal = false,
        public bool $reverse = false,
        public string|array $wrapperClass = '',
    ) {
        parent::__construct(
            name: $this->name,
            label: $this->label,
            size: $this->size,
            horizontal: $this->horizontal,
            wrapperClass: $this->wrapperClass
        );
    }

    /**
     * @return string
     */
    public function wrapperClass(): string
    {
        $classes = ['form-check'];

        if ($this->horizontal) {
            $classes[] = 'form-check-inline';
        }

        if ($this->reverse) {
            $classes[] = 'form-check-reverse';
        }

        if ($this->type === 'switch') {
            $classes[] = 'form-switch';
        }

        if (!empty($this->wrapperClass)) {
            $classes = array_merge($classes, (array)$this->wrapperClass);
        }

        return implode(' ', $classes);
    }

    /**
     * @return string
     */
    public function labelClass(): string
    {
        if (str_starts_with($this->type, 'btn-')) {
            return sprintf(
                'btn %s',
                $this->type
            );
        }

        return 'form-check-label';
    }

    /**
     * @return void
     */
    protected function determineViewByType(): void
    {
        // Only a single view is supported
    }

    /**
     * Override to transform/add attributes at render time
     *
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        $attributes['type'] = 'checkbox';

        $attributes = $attributes->class(
            [
                str_starts_with($this->type, 'btn-') ? 'btn-check' : 'form-check-input',
                'form-control-' . $this->size => isset($this->size) && $this->size !== 'md',
            ]
        );

        if ($this->disabled) {
            $attributes['disabled'] = true;
        }

        if ($this->checked) {
            $attributes['checked'] = true;
        }

        if (str_starts_with($this->type, 'btn-')) {
            $attributes['autocomplete'] = 'off';
        }

        if ($this->type === 'switch') {
            $attributes['role'] = 'switch';
        }

        return parent::transformAttributes($attributes);
    }
}
