<?php

namespace StoneHilt\Bootstrap\Components\Form\ControlGroup;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;

/**
 * Class TextareaItem
 *
 * @package StoneHilt\Bootstrap\Components\Form\ControlGroup
 */
class Textarea extends Base
{
    /**
     * @var array|string[]
     */
    protected static array $sizes = [
        'sm',
        'md',
        'lg',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::form.control-group.textarea';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public int $rows = 3,
        public ?string $size = null,
        public bool $disabled = false,
        public bool $readonly = false,
        public bool $plaintext = false,
        public ?array $datalist = null
    ) {
        parent::__construct();
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
                'form-control-' . $this->size => isset($this->size) && $this->size !== 'md',
            ]
        );

        if (!$attributes->has('name')) {
            $attributes['name'] = $this->name;
        }

        $attributes['rows'] = $this->rows;

        if ($this->disabled) {
            $attributes['disabled'] = true;
        }

        if ($this->readonly) {
            $attributes['readonly'] = true;
        }

        return parent::transformAttributes($attributes);
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        return [
            'size' => ['nullable', Rule::in(static::$sizes)]
        ];
    }
}