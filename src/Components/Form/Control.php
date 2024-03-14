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
     * Create a new component instance.
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
        public ?array $datalist = null
    ) {
        parent::__construct($this->name, $this->label, $this->size);
    }

    /**
     * @return void
     */
    protected function determineViewByType(): void
    {
        $this->viewName = match($this->type) {
            'textarea' => 'bootstrap::form.textarea',
            default    => $this->viewName
        };

        if ($this->horizontal) {
            $this->viewName .= '_horizontal';
        }
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
                'form-control-' . $this->size => !empty($this->size),
            ]
        );

        if ($this->type === 'textarea' && !$attributes->has('rows')) {
            $attributes['rows'] = 3;
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
