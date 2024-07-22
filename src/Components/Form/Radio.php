<?php

namespace StoneHilt\Bootstrap\Components\Form;

use Illuminate\View\ComponentAttributeBag;

/**
 * Class Radio
 *
 * @package StoneHilt\Bootstrap\Components\Form
 *
 */
class Radio extends AbstractFormComponent
{
    /**
     * @var array|string[] $variants
     */
    protected static array $types = [
        'radio',
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
    protected string $viewName = 'bootstrap::form.radio';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options,
        public string $type = 'radio',
        public ?string $checked = null,
        public ?string $size = null,
        public array $disabled = [],
        public bool $horizontal = false,
        public bool $reverse = false,
        public string|array $wrapperClass = 'mb-3',
    ) {
        parent::__construct(
            name: $this->name,
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

        return implode(' ', $classes);
    }

    /**
     * @return string
     */
    public function labelClass(mixed $value): string
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
     * @param string $value
     * @return bool
     */
    public function isChecked(string $value): bool
    {
        return ($this->checked === $value);
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
        $attributes['type'] = 'radio';

        $attributes = $attributes->class(
            [
                str_starts_with($this->type, 'btn-') ? 'btn-check' : 'form-check-input',
                'form-control-' . $this->size => !empty($this->size),
            ]
        );

        if ($this->disabled) {
            $attributes['disabled'] = true;
        }

        if (str_starts_with($this->type, 'btn-')) {
            $attributes['autocomplete'] = 'off';
        }

        return parent::transformAttributes($attributes);
    }
}
